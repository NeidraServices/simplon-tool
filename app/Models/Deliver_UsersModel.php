<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliver_UsersModel extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $fillable = [
        "titre", "description", "deadline", "image", "formateur_id", "extrait", "date_presentation"
    ];
    public function projets(){
        return $this->belongsToMany(Deliver_ProjetModel::class,"dp_affectations","projet_id","user_id");
    }

    public function medias(){
        return $this->hasMany(Deliver_MediaModel::class);
    }
}
