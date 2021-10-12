<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Page;

class AdminController extends Controller
{
    public function index()
    {
        $article_count  = Article::all()->count();
        $hit            = Article::sum('hit');
        $category_count = Category::all()->count();
        $page_count     = Page::all()->count();
        return view('backend.dashboard', compact('article_count', 'hit', 'category_count', 'page_count'));
    }
}
