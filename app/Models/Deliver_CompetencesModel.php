<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliver_CompetencesModel extends Model
{
    use HasFactory;
    protected $table = 'dp_competences';
    protected $fillable = [
        'nom'
    ];
    public function projets(){
        return $this->belongsToMany(Deliver_ProjetModel::class,"dp_projet_competences","projet_id","competence_id");
    }
}
