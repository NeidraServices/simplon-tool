<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvalUserSondagesComments extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'comments',
    ];

    public function users() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function sondages() {
        return $this->belongsTo(EvalSondage::class, 'sondage_id', 'id');
    }
}
