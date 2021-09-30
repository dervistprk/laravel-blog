<?php

namespace App\Models;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    public function articleCount(){
        return $this->hasMany(Article::class, 'category_id', 'id')->where('status', 1)->count();
    }

    public function articleCountPassive(){
        return $this->hasMany(Article::class, 'category_id', 'id')->where('status', 0)->count();
    }

    public function totalArticleCount(){
        return $this->hasMany(Article::class, 'category_id', 'id')->count();
    }
}
