<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliver_ProjetModel extends Model
{
    use HasFactory;
    protected $table = 'dp_projets';
    public function competences(){
        return $this->belongsToMany(Deliver_ProjetModel::class,"dp_projet_competences","competence_id","projet_id");
    }

    public function tags(){
        return $this->belongsToMany(Deliver_TagModel::class,"db_projet_tag","tag_id","projet_id");
    }
    
    public function users(){
        return $this->belongsToMany(Deliver_ProjetModel::class,"dp_affectations","user_id","projet_id");
    }

    public function rendus(){
        return $this->hasMany(Deliver_RendusModel::class);
    }
}
