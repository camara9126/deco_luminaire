<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Devis;
use App\Models\DevisDetail;
use App\Models\Entreprise;
use App\Models\MouvementStock;
use App\Models\Paiement;
use App\Models\Produit;
use App\Models\Recette;
use App\Models\Vente;
use App\Models\VenteItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class DevisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $devis = Devis::with('client')->latest()->paginate(10);
        return view('dashboard.devis.index', compact('devis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        $produits = Produit::all();

        return view('dashboard.devis.create', compact('clients', 'produits'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id' ,
            'designation' => 'required|array',
            'designation.*.nom' => 'required',
            'designation.*.quantite' => 'required|numeric|min:1',
            'designation.*.prix_vente' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
    //dd($request);
        try {

            // Création du devis
            $devis = Devis::create([
                'reference' => 'DEV-' . strtoupper(Str::random(6)),
                'client_id' => $request->client_id ?? null,
                'total' => 0,
                'statut' => 'en_attente',
                'date_devis' => now(),
                'date_expiration' => now()->addDays(7),
            ]);

            $total = 0;

            // Enregistrement des designations
            foreach ($request->designation as $item) {

                $ligneTotal = $item['quantite'] * $item['prix_vente'];

                DevisDetail::create([
                    'devis_id' => $devis->id,
                    'designation' => $item['nom'],
                    'produit_id' => $item['produit_id'] ?? null,
                    'quantite' => $item['quantite'],
                    'prix_unitaire' => $item['prix_vente'],
                    'total' => $ligneTotal,
                ]);

                $total += $ligneTotal;
            }

            // Mise à jour du total
            $devis->update([
                'total' => $total
            ]);

            DB::commit();

            return redirect()->route('devis.index')->with('success', 'Devis créé avec succès');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('danger', 'Erreur lors de la conversion: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $produits= Produit::latest()->get();

        $devis = Devis::with('client', 'details')->findOrFail($id);

        return view('dashboard.devis.show', compact('devis','produits'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $devis= Devis::with('client', 'details')->findOrFail($id);
//dd($devis);
        $clients = Client::all();
        $produits = Produit::all();

        return view('dashboard.devis.edit', compact('devis', 'clients', 'produits'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'client_id' ,
            'designation' => 'required|array',
            'designation.*.nom' => 'required',
            'designation.*.quantite' => 'required|numeric|min:1',
            'designation.*.prix_vente' => 'numeric|min:0',
        ]);

        DB::beginTransaction();
    //dd($request);
        try {
            $devis= Devis::with('client', 'details')->findOrFail($id);

            // Suppressionm des anciens details devis
            $devis->details()->delete();

            $total = 0;
            //dd($request->produits);

            // Recreer les nouveaux details
            foreach ($request->designation as $item) {

                $ligneTotal = $item['quantite'] * $item['prix_vente'];

                DevisDetail::create([
                    'devis_id' => $devis->id,
                    'designation' => $item['nom'],
                    'produit_id' => $item['produit_id'] ?? null,
                    'quantite' => $item['quantite'],
                    'prix_unitaire' => $item['prix_vente'],
                    'total' => $ligneTotal,
                ]);

                $total += $ligneTotal;
            }

            // Mise à jour du total
            $devis->update([
                'client_id' => $request->client_id,
                'total' => $total,
                'date_devis' => now()
            ]);

         DB::commit();

            return redirect()->route('devis.index')->with('success', 'Devis modifiéé avec succès');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('danger', 'Erreur lors de la conversion: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $devis = Devis::findOrFail($id);
        $devis->delete();

        return redirect()->route('devis.index')->with('success', 'Devis supprimé');
    }

    /**
     * Valider un devis
     */
    public function valider($id)
    {
        $devis = Devis::findOrFail($id);

        $devis->update([
            'statut' => 'valide'
        ]);

        return redirect()->route('devis.index')->with('success', 'Devis validé');
    }

    /**
     * Refuser un devis
     */
    public function refuser($id)
    {
        $devis = Devis::findOrFail($id);

        $devis->update([
            'statut' => 'refuse'
        ]);

        return redirect()->route('devis.index')->with('success', 'Devis refusé');
    }

    /**
     * Convertir devis en vente
     */
    public function convertir(Request $request, string $devis)
    {
        
        DB::beginTransaction();
    
        try {
            $devis = Devis::with('client', 'details')->findOrFail($devis);

            // Vérifier si le devis est déjà converti
                if ($devis->converti_en_vente == 1) {
                    return redirect()->route('devis.index')->with('success','Ce devis a déjà été converti en vente.');
                } 
            

            // Créer la vente
            $vente = Vente::create([
                'reference' => 'VNT-' . time(),
                'date' => now(),
                'client_id' => $devis->client_id,
                'total' => $devis->total,
                'total_tva' => 0,
                'total_ttc' => 0,
                'statut' => 'impayee',
                'user_id' => $request->user()->id,
            ]);

                $total = 0;
                $total_tva = 0;
                $total_ttc = 0;

            $entreprise= Entreprise::findOrFail(1); // Recuperation de la TVA de l'entreprise

            // Ajouter les produits
            foreach ($devis->details as $detail) {          

                VenteItem::create([
                'vente_id' => $vente->id,
                'designation' => $detail->designation,
                'produit_id' => $detail->produit_id ?? null,
                'quantite' => $detail->quantite,
                'prix_unitaire' => $detail->prix_unitaire,
                'taux_tva' => $entreprise->taux_tva,
                'montant_tva' => ($detail->quantite * $detail->prix_unitaire) * ($entreprise->taux_tva / 100),
                'total_ttc' => ($detail->quantite * $detail->prix_unitaire) + (($detail->quantite * $detail->prix_unitaire) * ($entreprise->taux_tva / 100)),
                'total' => $detail->quantite * $detail->prix_unitaire,
            ]);

            // Enregistrement historique stock
            MouvementStock::create([
                'designation' => $detail->designation,
                'type' => 'sortie',
                'quantite' => $detail->quantite,
                'reference' => 'MVT-' . now()->timestamp,
            ]);

            // Calcul des totaux
            $total += $detail->quantite * $detail->prix_unitaire;
            $total_tva += ($detail->quantite * $detail->prix_unitaire) * ($entreprise->taux_tva / 100);
            $total_ttc += ($detail->quantite * $detail->prix_unitaire) + (($detail->quantite * $detail->prix_unitaire) * ($entreprise->taux_tva / 100));

            }

            // Mise a jour total + total_tva + total_ttc
            $vente->update([
                'total' => $total,
                'total_tva' => $total_tva,
                'total_ttc' => $total_ttc,
            ]);


            // Mise a jour Devis
            $devis->update([
                'converti_en_vente' => 1
            ]);

            // creation paiement
                $paiement = $vente;

                $totalPaye = $paiement->paiements()->where('statut','valide')->sum('montant');

                $paiements= Paiement::create([
                    'vente_id' => $vente->id,
                    'user_id' => request()->user()->id,
                    'montant' => $vente->total_ttc,
                    'mode_paiement' => 'cash',
                    'date_paiement' => now(),
                    'statut' => 'valide',
                    'reference' => 'PAY-' . time()
                ]);


                // Mise à jour du statut de la vente
                $vente = $paiements->vente;

                $totalPaye = $vente->paiements()->where('statut','valide')->sum('montant');

                $vente->statut = $totalPaye == 0 ? 'impayee' : ($totalPaye < $vente->total_ttc ? 'partielle' : 'payee');

                $vente->save();


                // 2. Création automatique de la recette
                if($vente->statut == 'payee') {
                    Recette::create([
                        'user_id' => $request->user()->id,
                        'paiement_id' => $paiements->id,
                        'reference' => 'REC-' . now()->timestamp,
                        'libelle' => 'Paiement vente ' . $vente->reference,
                        'montant' => $vente->total_ttc,
                        'date_recette' => now(),
                        'mode_paiement' => 'cash',
                        'statut' => 'recu',
                    ]);
                }

                DB::commit();
                return redirect()->route('vente.index', $vente->id)->with('success', 'Devis converti en vente');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('danger', 'Erreur lors de la conversion: ' . $e->getMessage());
        }
    }


    // Facture
    public function facture($id)
    {
        $entreprise= Entreprise::findOrFail(1);


        $produits= produit::latest()->get();

        $devis = Devis::with('client', 'details')->findOrFail($id);

        $devis->load(['client', 'details']);
//dd($devis);
        $pdf = Pdf::loadView('dashboard.devis.facture', compact('devis', 'entreprise'));

        return $pdf->stream ('Facture-' . $devis->reference . '.pdf');
    }
}
