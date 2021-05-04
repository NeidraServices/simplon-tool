<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliver_MediaModel extends Model
{
    use HasFactory;
    protected $table = 'dp_medias';
    public function users(){    
        return $this->belongsTo(Deliver_UsersModel::class);
    }

    public function projets(){
        return $this->belongsTo(Deliver_ProjetModel::class,"projet_id","id");
    }
}
