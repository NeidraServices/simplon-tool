<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Markdown_User extends Model
{
    use HasFactory;

    protected $table = 'users';
    protected $fillable = ['name'];
    
    public function markdown(){
        return $this->hasMany(Markdown_Markdown::class);
    }
    public function contribution(){
        return $this->hasMany(Markdown_Contribution::class);
    }
}
