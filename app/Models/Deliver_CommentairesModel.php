<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliver_CommentairesModel extends Model
{
    use HasFactory;
    protected $table = 'dp_commentaires';
    public function users(){
        return $this->belongsTo(Deliver_UsersModel::class,"user_id","id");
    }
    public function projets(){
        return $this->belongsTo(Deliver_ProjetModel::class,"user_id","id");
    }

    public function commentaires(){
        return $this->belongsTo(Deliver_CommentairesModel::class,"user_id","id");
    }
}
