<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliver_CommentairesModel extends Model
{
    use HasFactory;
    protected $table = 'dp_commentaires';
    protected $fillable = [
        'text',"projet_id","user_id","commentaire_id"
    ];
    public function users(){
        return $this->belongsTo(Deliver_UsersModel::class,"user_id","id");
    }
    public function projets(){
        return $this->belongsTo(Deliver_ProjetModel::class,"projet_id","id");
    }

    public function reponses(){
        return $this->hasMany(Deliver_CommentairesModel::class,"commentaire_id","id");
    }
}
