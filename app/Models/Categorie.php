<?php

namespace App\Models;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $fillable = [
        'nom',
        'slug',
        'description',
        'image',
    ];


    public function produit() {
        return $this->hasMany(Produit::class);
    }


    // creation de slug a chaque categorie
        protected static function boot()
            {
                parent::boot();
            
                static::saving(function ($categorie) {
                    if (empty($categorie->slug)) {
                        $slug = Str::slug($categorie->nom);
                        $originalSlug = $slug;
            
                        // Vérifier l'unicité du slug
                        $count = 1;
                        while (Categorie::where('slug', $slug)->exists()) {
                            $slug = $originalSlug . '-' . $count;
                            $count++;
                        }
            
                        $categorie->slug = $slug;
                    }
                });
            }
}
