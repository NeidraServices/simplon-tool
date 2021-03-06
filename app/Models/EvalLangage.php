<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvalLangage extends Model
{
    use HasFactory;

    public $directory = 'langages/';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image',
        'name',
    ];

    function langage()
    {
        return $this->hasMany(EvalSondageLines::class, 'langage_id');
    }

    /**
     * Accessor to get image path
     */
    public function getImageAttribute($value)
    {
        return $this->directory . $value;
    }
}
