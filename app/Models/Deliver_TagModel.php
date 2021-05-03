<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliver_TagModel extends Model
{
    use HasFactory;

    public function projets(){
        return $this->belongsToMany(Deliver_ProjetModel::class,"tag_projet","projet","tag_id");
    }
}
