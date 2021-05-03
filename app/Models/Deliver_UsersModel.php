<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliver_UsersModel extends Model
{
    use HasFactory;
    
    public function projets(){
        return $this->belongsToMany(Deliver_ProjetModel::class,"affectation_projet","projet_id","user_id");
    }

    public function medias(){
        return $this->hasMany(Deliver_MediaModel::class);
    }
}
