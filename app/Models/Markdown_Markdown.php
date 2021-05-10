<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Markdown_User;
use App\Models\Markdown_Category;
use App\Models\Markdown_Contribution;

class Markdown_Markdown extends Model
{
    use HasFactory;

    protected $table = 'markdowns';
    protected $fillable = ['url', 'active','title','description'];

    public function users()
    {
        return $this->belongsTo(Markdown_User::class, 'user_id');
    }
    public function categories()
    {
        return $this->belongsTo(Markdown_Category::class, 'md_category_id');
    }
    public function commentaries()
    {
        return $this->hasMany(Markdown_Commentary::class , 'markdown_id');
    }
    public function contributions()
    {
        return $this->hasMany(Markdown_Contribution::class , 'markdown_id');
    }
}
