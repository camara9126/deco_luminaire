<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Produit extends Model
{
     protected $fillable = [
        'fournisseur_id',
        'nom',
        'slug',
        'code',
        'prix_achat',
        'prix_vente',
        'reference',
        'description',
        'image',
        'stock',
        'stock_min',
        'categorie_id',
        'statut',
    ];


    public function categorie() {
        return $this->belongsTo(Categorie::class);
    }

    // creation de slug a chaque produit
        protected static function boot()
            {
                parent::boot();
            
                static::saving(function ($produit) {
                    if (empty($produit->slug)) {
                        $slug = Str::slug($produit->nom);
                        $originalSlug = $slug;
            
                        // Vérifier l'unicité du slug
                        $count = 1;
                        while (Produit::where('slug', $slug)->exists()) {
                            $slug = $originalSlug . '-' . $count;
                            $count++;
                        }
            
                        $produit->slug = $slug;
                    }
                });
            }
}
