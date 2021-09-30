<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('backend.categories.index', compact('categories'));
    }

    public function create(Request $request){
        $request->validate([
                               'category' => 'required|min:3',
                               'image'    => 'required|image|mimes:jpeg,png,jpg|max:2048',
                           ]);
        $isExist = Category::whereSlug(Str::slug($request->category))->first();

        if($isExist){
            toastr()->error($request->category . ' kategorisi zaten mevcut!');
            return redirect()->back();
        }

        $category       = new Category();
        $category->name = $request->category;
        $category->slug = Str::slug($request->category);

        if($request->hasFile('image')){
            $imageName = Str::slug($request->category) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads_category'), $imageName);
            $category->image = 'uploads_category/' . $imageName;
        }

        $category->save();
        toastr()->success('Kategori başarıyla oluşturuldu.');
        return redirect()->back();
    }

    public function getData(Request $request){
        $category = Category::findOrFail($request->id);
        return response()->json($category);
    }

    public function update(Request $request){
        $isExistSlug = Category::whereSlug(Str::slug($request->slug))->whereNotIn('id', [$request->id])->first();
        $isExistName = Category::whereName($request->category)->whereNotIn('id', [$request->id])->first();

        if($isExistSlug || $isExistName){
            toastr()->error($request->category . ' kategorisi zaten mevcut!');
            return redirect()->back();
        }

        $request->validate([
                               'category' => 'required|min:3',
                               'image'    => 'image|mimes:jpeg,png,jpg|max:2048',
                           ]);

        $category       = Category::find($request->id);
        $category->name = $request->category;
        $category->slug = Str::slug($request->slug);

        if($request->hasFile('image')){
            $imageName = Str::slug($request->category) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads_category'), $imageName);
            $category->image = 'uploads_category/' . $imageName;
        }

        $category->save();
        toastr()->success('Kategori başarıyla güncellendi.');
        return redirect()->back();
    }

    public function switch(Request $request){
        $category         = Category::findOrFail($request->id);
        $category->status = $request->statu == 'true' ? 1 : 0;
        $category->save();
    }

    public function delete(Request $request){
        $category = Category::findOrFail($request->deleteId);

        if($category->id == 1){
            toastr()->error('Bu kategori silinemez.');
            return redirect()->back();
        }

        $message = '';
        $count   = $category->articleCount();

        if($count > 0){
            Article::where('category_id', $category->id)->update(['category_id' => 1]);
            $default_category = Category::find(1);
            $message          = 'Bu kategoriye ait <b>' . $count . '</b> adet makale <b>' . $default_category->name . '</b> kategorisine taşındı.';
        }

        $category->delete();
        toastr()->success($message, 'Kategori başarıyla silindi.');
        return redirect()->back();
    }

}
