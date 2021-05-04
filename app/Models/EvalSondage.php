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

    function sondage()
    {
        return $this->hasMany(EvalSondageLines::class, 'sondage_id');
    }

    function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
