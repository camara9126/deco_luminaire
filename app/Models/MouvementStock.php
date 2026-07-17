<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MouvementStock extends Model
{
      protected $fillable = [
        'produit_id',
        'type',
        'quantite',
        'reference',
    ];

    public function produit()
    {
        return $this->belongsTo((Produit::class));
    }
}
