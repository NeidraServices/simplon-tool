<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Markdown_Category extends Model
{
    use HasFactory;

    protected $table = 'md_categories';
    protected $fillable = ['name'];

    public function markdown(){
        return $this->hasMany(Markdown_Markdown::class);
    }
}
