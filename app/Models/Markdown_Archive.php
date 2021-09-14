<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Markdown_Markdown;

class Markdown_Archive extends Model
{
    use HasFactory;

    protected $table = 'md_archives';
    protected $fillable = ['title','category_id','markdown_id','url', 'description'];

    public function markdown()
    {
        return $this->belongsTo(Markdown_Markdown::class, 'markdown_id');
    }
    
    public function categories()
    {
        return $this->belongsTo(Markdown_Category::class, 'category_id');
    }
}
