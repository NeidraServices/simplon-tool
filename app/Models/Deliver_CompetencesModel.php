<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliver_CompetencesModel extends Model
{
    use HasFactory;

    public function projets(){
        return $this->belongsToMany(Deliver_ProjetModel::class,"competence_projet","projet_id","competence_id");
    }
}
