<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvalUsersAnswerLines extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'note',
    ];

    public function users() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function sondageLines() {
        return $this->belongsTo(EvalSondageLines::class, 'sondage_line_id', 'id');
    }
}
