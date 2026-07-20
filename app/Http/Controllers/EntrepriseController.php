<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EntrepriseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.entreprise.index');
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
        $user= request()->user();

        $request->validate([
            'nom' => 'string|max:255',
            'adresse' => 'string',
            'contact' => 'numeric|min:9',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Gestion des logo
        if ($request->hasFile('logo')) {

            $filename = time().$request->file('logo')->getClientOriginalName();
            $path = $request->file('logo')->storeAs('logo', $filename, 'public');
            $request['logo'] = '/storage/' . $path;
        }


         $entreprise= Entreprise::create([
            'nom' => $request->nom,
            'adresse' => $request->adresse,
            'contact' => $request->contact,
            'logo' =>  $path ?? null,
            'statut' => 0,
         ]);

         $user->update([
            'entreprise_id' => $entreprise->id
            ]);


        return redirect()->back()->with('success', 'Entreprise cree');
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
        $entreprise = entreprise::FindOrFail($id);

         $request->validate([
            'nom' => 'string',
            'contact' => 'nullable|string|max:50',
            'taux_tva' => 'numeric|max:100',
            'adresse' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ninea' => 'nullable',
        ]);

        // Gestion des logo
        if ($request->hasFile('logo')) {
            
            if($entreprise->logo){
                Storage::delete('public/logo/'.$entreprise->logo);
            }

            $filename = time().$request->file('logo')->getClientOriginalName();
            $path = $request->file('logo')->storeAs('logo', $filename, 'public');
            $request['logo'] = '/storage/' . $path;
           
        } else {
            $entreprise->logo;
        }

        $entreprise->update([
            'nom' => $request->nom,
            'contact' => $request->contact,
            'taux_tva' => $request->taux_tva,
            'adresse' => $request->adresse,
            'logo' => $path  ?? $entreprise->logo,
            'ninea' => $request->ninea  ?? null,
        ]);


        // Lier l'utilisateur a l'entreprise
        $user= $request->user();
        $user->save();

        return redirect()->back()->with('success', 'entreprise mise a jour avec success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
