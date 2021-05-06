<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliver_Rendu extends Model
{
    use HasFactory;
    protected $table = 'dp_rendus';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'github_url',
        'site_url',
    ];

    public function medias(){
        return $this->hasMany(Deliver_MediaModel::class, "rendu_id");
    }
}
