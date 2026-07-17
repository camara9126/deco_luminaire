<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DevisDetail extends Model
{
     protected $fillable = [
        'devis_id',
        'produit_id',
        'quantite',
        'prix_unitaire',
        'total',
    ];

    
    public function details()
    {
        return $this->hasMany(DevisDetail::class);
    }

    public function produit() {
        return $this->belongsTo(Produit::class);
    }
}
