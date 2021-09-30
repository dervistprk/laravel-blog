<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index(){
        $pages = Page::all()->sortBy('order');
        return view('backend.pages.index', compact('pages'));
    }

    public function create(){
        return view('backend.pages.create');
    }

    public function createPost(Request $request){
        $request->validate([
                               'title'   => 'min:3',
                               'image'   => 'required|image|mimes:jpeg,png,jpg|max:2048',
                               'content' => 'min:30',
                           ]);
        $last_page_order = Page::orderBy('order', 'desc')->first();

        $page          = new Page();
        $page->title   = $request->title;
        $page->content = $request->content;
        $page->order   = $last_page_order->order + 1;
        $page->slug    = Str::slug($request->title);

        if($request->hasFile('image')){
            $imageName = Str::slug($request->title) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads_pages'), $imageName);
            $page->image = 'uploads_pages/' . $imageName;
        }
        $page->save();
        toastr()->success('Sayfa Başarıyla Oluşturuldu');
        return redirect()->route('admin.pages.index');
    }


    public function switch(Request $request){
        $article         = Page::findOrFail($request->id);
        $article->status = $request->statu == 'true' ? 1 : 0;
        $article->save();
    }

    public function update($id){
        $page = Page::findOrFail($id);
        return view('backend.pages.edit', compact('page'));
    }

    public function updatePost(Request $request, $id){
        $request->validate([
                               'title'   => 'min:3',
                               'image'   => 'image|mimes:jpeg,png,jpg|max:2048',
                               'content' => 'min:30',
                           ]);
        $page          = Page::findOrFail($id);
        $page->title   = $request->title;
        $page->content = $request->content;
        $page->slug    = Str::slug($request->title);
        if($request->hasFile('image')){
            $imageName = Str::slug($request->title) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads_pages'), $imageName);
            $page->image = 'uploads_pages/' . $imageName;
        }
        $page->save();
        toastr()->success('Sayfa Başarıyla Güncellendi');
        return redirect()->route('admin.pages.index');
    }

    public function delete($id){
        $page = Page::find($id);
        if(File::exists($page->image)){
            File::delete(public_path($page->image));
        }
        $page->delete();
        toastr()->success('Sayfa Başarıyla Silindi.');
        return redirect()->back();
    }

    public function orders(Request $request){
        foreach($request->get('page') as $key => $order){
            Page::where('id', $order)->update(['order' => $key]);
        }
    }


}
