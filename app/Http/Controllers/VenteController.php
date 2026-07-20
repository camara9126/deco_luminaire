<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use App\Models\Vente;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class VenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $entreprise= Entreprise::findOrFail(1);
        $vente= Vente::with('client', 'items', 'paiements')->findOrFail($id);
//dd($vente);
        $vente->load(['client', 'items', 'paiements']);

        $pdf = Pdf::loadView('dashboard.ventes.PDF', compact('vente', 'entreprise'));

        return $pdf->stream('Facture-' . $vente->reference . '.pdf');
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
        $vente= Vente::findOrFail($id);        
        $vente->destroy($id);

        return redirect()->back()->with('success', ' Facture supprimé avec succès');
    }

    // Liste de factures
    public function facture()
    {
        
        $user= request()->user();

        $factures = Vente::with('client')->latest()->paginate(10); 

        return view('dashboard.ventes.facture', compact('factures','user'));
    }
}
