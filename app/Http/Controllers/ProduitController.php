<?php

namespace App\Http\Controllers;
use App\Models\Produit;
use App\Models\Categorie;
use App\Models\Entreprise;
use App\Models\Fournisseur;

use Illuminate\Http\Request;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produits= Produit::latest()->get();
        $categories= Categorie::latest()->get();
        $fournisseurs= Fournisseur::latest()->get();

        return view('dashboard.produits.index', compact('produits','categories','fournisseurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required','string',
            'description' => 'nullable',
            'prix_achat' ,
            'prix_vente' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock' ,
            'stock_min' ,
            'fournisseur_id',
            'categorie_id',
            'categorie' ,
            'fournisseur' ,
            
        ]);

        $entreprise= Entreprise::findOrFail(1)->get();

       //dd($request);
        // Gestion de l'images principal
        if ($request->hasFile('image')) {
            $filename = time().$request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('imgproduits', $filename, 'public');
            $request['image'] = '/storage/' . $path;
        } else {
            $entreprise->logo;
        }


        // Creation de categorie et ou fournisseur
        if($request->categorie) {
            
            $categorie= Categorie::create([
                'nom' => $request->categorie
            ]);

        }

        //Creation de fournisseur
        if($request->fournisseur) {
            
            $fournisseur= Fournisseur::create([
                'nom' => $request->fournisseur
            ]);

        }
       
        $produits= Produit::create([
            'nom' => $request->nom,
            'description' => $request->description ?? null,
            'prix_achat' => $request->prix_achat ?? $request->prix_vente,
            'prix_vente' => $request->prix_vente,
            'code' => $this->generateCode(),
            'reference' => 'REF-' . now()->timestamp,
            'stock' => $stock  ?? 100,
            'stock_min' => $request->stock_min ?? 10,
            'fournisseur_id' => $request->fournisseur_id ?? $fournisseur->id,
            'categorie_id' => $request->categorie_id ?? $categorie->id,
            'image' => $path ?? $entreprise->logo,
        ]);

        return redirect()->route('produit.index')->with('success', 'Produit crée avec success.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


        // Generateur de code produit 
    private function generateCode(): string
    {
        $lastProduit = Produit::orderBy('id', 'desc')->first();

        $number = $lastProduit ? intval(substr($lastProduit->code, -5)) + 1 : 1;

        return 'PRD-' . str_pad($number, 5, '0', STR_PAD_LEFT);
    }
}
