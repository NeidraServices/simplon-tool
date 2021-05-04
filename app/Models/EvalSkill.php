<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvalSkill extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description', 'referentiel_id'
    ];

    function referentiel()
    {
        return $this->belongsTo(EvalReferentiel::class, 'referentiel_id');
    }

    function skill()
    {
        return $this->hasMany(EvalSondageLines::class, 'skill_id');
    }

}
