<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliver_RendusModel extends Model
{
    use HasFactory;
    protected $table = 'dp_rendus';

    public function projets(){
        return $this->belongsTo(Deliver_ProjetModel::class,"projet_id","id");
    }

    public function medias(){
        return $this->hasMany(Deliver_MediaModel::class,"rendu_id");
    }

    public function tags(){
        return $this->belongsToMany(Deliver_TagModel::class,"tag_rendu","tag_id","rendu_id");
    }
}
