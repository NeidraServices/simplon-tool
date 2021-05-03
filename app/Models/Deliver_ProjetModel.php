<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliver_ProjetModel extends Model
{
    use HasFactory;

    public function competences(){
        return $this->belongsToMany(Deliver_CompetencesModel::class,"competence_projet","competence_id","projet_id");
    }

    public function tags(){
        return $this->belongsToMany(Deliver_TagModel::class,"tag_projet","tag_id","projet_id");
    }
    
    public function users(){
        return $this->belongsToMany(Deliver_ProjetModel::class,"affectation_projet","user_id","projet_id");
    }

    public function medias(){
        return $this->hasMany(Deliver_MediaModel::class);
    }
}