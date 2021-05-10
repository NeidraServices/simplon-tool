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
        'note',
        'question',
        'type',
        'sondage_id',
        'skill_id',
        'langage_id'
    ];

    public function sondage()
    {
        return $this->belongsTo(EvalSondage::class, 'sondage_id');
    }

    public function skill()
    {
        return $this->belongsTo(EvalSkill::class, 'skill_id');
    }

    public function langage()
    {
        return $this->belongsTo(EvalLangage::class, 'langage_id');
    }

    public function answers() {
        return $this->belongsTo(EvalUsersAnswerLines::class, 'sondage_line_id');
    }
}
