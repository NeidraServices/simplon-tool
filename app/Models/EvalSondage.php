<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvalSondage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'comments',
        'global_note',
        'user_id'
    ];

    public function sondage()
    {
        return $this->hasMany(EvalSondageLines::class, 'sondage_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function userComments()
    {
        return $this->hasMany(EvalUserSondagesComments::class, 'sondage_id');
    }
}
