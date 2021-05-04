<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliver_TagModel extends Model
{
    use HasFactory;
    protected $table = 'dp_tags';
    public function projets(){
        return $this->belongsToMany(Deliver_ProjetModel::class,"db_projet_tag","projet","tag_id");
    }

    public function rendus(){
        return $this->belongsToMany(Deliver_TagModel::class,"tag_rendu","tag_id","rendu_id");
    }
}
