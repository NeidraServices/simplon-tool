<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Deliver_ProjetModel extends Model
{
    use HasFactory;
    protected $table = 'dp_projets';
    protected $fillable = [
        "titre", "description", "deadline", "image", "formateur_id", "extrait", "date_presentation"
    ];

    public function competences(){
        return $this->belongsToMany(Deliver_ProjetModel::class,"dp_projet_competences","competence_id","projet_id");
    }

    public function tags(){
        return $this->belongsToMany(Deliver_TagModel::class,"dp_projet_tags","tag_id","projet_id");
    }

    // Apprenants
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class,"dp_affectations","projet_id","user_id");
    }

    public function rendus(){
        return $this->hasMany(Deliver_Rendu::class);
    }

    public function commentaires(){
        return $this->hasMany(Deliver_ProjetModel::class);
    }
}
