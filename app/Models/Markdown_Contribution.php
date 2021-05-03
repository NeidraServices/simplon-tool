<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Markdown_User;
use App\Models\Markdown_Markdown;

class Markdown_Contribution extends Model
{
    use HasFactory;

    protected $table = 'contributions';
    protected $fillable = ['url', 'active'];

    public function users()
    {
        return $this->belongsTo(Markdown_User::class, 'user_id');
    }
    public function markdown()
    {
        return $this->belongsTo(Markdown_Markdown::class, 'markdown_id');
    }
}
