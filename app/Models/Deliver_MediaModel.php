<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliver_MediaModel extends Model
{
    use HasFactory;
    protected $table = 'dp_medias';

    protected $fillable = [
        'type',
        'lien',
        'nom',
    ];

    function rendus()
    {
        return $this->belongsTo(Deliver_Rendu::class);
    }
}
