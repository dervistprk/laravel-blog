<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    public function __construct(){
        $articles = Article::with('category')->get();
        foreach($articles as $article){
            if($article->category->status == 0){
                $article->status = 0;
                $article->save();
            }
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(){
        $articles = Article::orderBy('created_at', 'DESC')->get();
        return view('backend.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(){
        $categories = Category::all();
        return view('backend.articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request){
        $request->validate([
                               'title'   => 'min:3',
                               'image'   => 'required|image|mimes:jpeg,png,jpg|max:2048',
                               'content' => 'min:30',
                           ]);
        $article              = new Article();
        $article->title       = $request->title;
        $article->category_id = $request->category;
        $article->content     = $request->content;
        $article->slug        = Str::slug($request->title);

        if($request->hasFile('image')){
            $imageName = Str::slug($request->title) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $article->image = 'uploads/' . $imageName;
        }
        $article->save();
        toastr()->success('Makale Başarıyla Oluşturuldu', 'Başarılı');
        return redirect()->route('admin.makaleler.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit($id){
        $article    = Article::findOrFail($id);
        $categories = Category::all();
        return view('backend.articles.edit', compact('categories', 'article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int     $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id){
        $request->validate([
                               'title'   => 'min:3',
                               'image'   => 'image|mimes:jpeg,png,jpg|max:2048',
                               'content' => 'min:30',
                           ]);
        $article              = Article::findOrFail($id);
        $article->title       = $request->title;
        $article->category_id = $request->category;
        $article->content     = $request->content;
        $article->slug        = Str::slug($request->title);
        if($request->hasFile('image')){
            $imageName = Str::slug($request->title) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $article->image = 'uploads/' . $imageName;
        }
        $article->save();
        toastr()->success('Makale Başarıyla Güncellendi', 'Başarılı');
        return redirect()->route('admin.makaleler.index');
    }

    public function switch(Request $request){
        $article         = Article::findOrFail($request->id);
        $article->status = $request->statu == 'true' ? 1 : 0;
        $article->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */

    public function delete($id){
        Article::findOrFail($id)->delete();
        toastr()->success('Makale, Başarıyla Silinmiş Makalelere Taşındı.');
        return redirect()->route('admin.makaleler.index');
    }

    public function trashed(){
        $articles = Article::onlyTrashed()->orderBy('deleted_at', 'DESC')->get();
        return view('backend.articles.trashed', compact('articles'));
    }

    public function recover($id){
        Article::onlyTrashed()->find($id)->restore();
        toastr()->success('Makale Başarıyla Kurtarıldı.');
        return redirect()->back();
    }

    public function hardDelete($id){
        $article = Article::onlyTrashed()->find($id);
        if(File::exists($article->image)){
            File::delete(public_path($article->image));
        }
        $article->forceDelete();
        toastr()->success('Makale Başarıyla Silindi.');
        return redirect()->back();
    }


}
