<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvalNotification extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'from',
        'to',
        'object',
    ];

    function to()
    {
        return $this->belongsTo(User::class, 'to');
    }


    function from()
    {
        return $this->belongsTo(User::class, 'from');
    }
}
