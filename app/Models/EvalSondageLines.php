<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvalSondageLines extends Model
{
    use HasFactory;

    protected $table = "eval_sondages_lines";
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sondage_id',
        'skill_id',
        'langage_id'
    ];

    function sondage()
    {
        return $this->belongsTo(EvalSondage::class, 'sondage_id');
    }

    function skill()
    {
        return $this->belongsTo(EvalSkill::class, 'skill_id');
    }

    function langage()
    {
        return $this->belongsTo(EvalLangage::class, 'langage_id');
    }
}
