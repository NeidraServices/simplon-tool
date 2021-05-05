<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Markdown_User;
use App\Models\Markdown_Category;

class Markdown_Markdown extends Model
{
    use HasFactory;

    protected $table = 'markdowns';
    protected $fillable = ['url', 'active'];

    public function users()
    {
        return $this->belongsTo(Markdown_User::class, 'user_id');
    }
    public function categories()
    {
        return $this->belongsTo(Markdown_Category::class, 'md_category_id');
    }
}
