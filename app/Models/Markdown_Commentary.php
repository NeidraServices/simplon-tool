<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Markdown_User;
use App\Models\Markdown_Markdown;

class Markdown_Commentary extends Model
{   
    use HasFactory;

    protected $table = 'md_commentaries';
    protected $fillable = ['description'];

    public function users()
    {
        return $this->belongsTo(Markdown_User::class, 'user_id');
    }
    
    public function markdown()
    {
        return $this->belongsTo(Markdown_Markdown::class, 'markdown_id');
    }
}
