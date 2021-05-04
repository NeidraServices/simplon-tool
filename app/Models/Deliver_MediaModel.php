<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliver_MediaModel extends Model
{
    use HasFactory;
    protected $table = 'dp_medias';

    public function rendus(){
        return $this->belongsTo(Deliver_RendusModel::class,"rendu_id","id");
    }
}
