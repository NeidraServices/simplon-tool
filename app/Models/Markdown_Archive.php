<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Markdown_Markdown;

class Markdown_Archive extends Model
{
    use HasFactory;

    protected $table = 'md_archives';
    protected $fillable = ['url'];

    public function markdown()
    {
        return $this->belongsTo(Markdown_Markdown::class, 'markdown_id');
    }
}
