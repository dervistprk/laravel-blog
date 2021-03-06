<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;
use App\Models\Page;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function __construct()
    {
        if(Config::find(1)->active == 0){
            redirect()->to('bakimdayiz')->send();
        }

        view()->share('pages', Page::where('status', 1)->orderBy('order')->get());
        view()->share('categories', Category::orderBy('name')->where('status', 1)->get());
        view()->share('config', Config::find(1));
    }

    public function index(Request $request)
    {
        if(isset($request->search)){
            $articles = Article::where('title', 'like', '%' . $request->search . '%')->orderBy('created_at', 'desc')->paginate(5);
            return view('frontend.home', compact('articles'));
        }
        $articles = Article::with('category')->where('status', 1)->whereHas('category', function($query){
            $query->where('status', 1);
        })->orderBy('created_at', 'DESC')->paginate(5);
        $articles->withPath(url('sayfa'));
        $most_viewed = Article::orderBy('hit', 'desc')->limit(3)->get();
        return view('frontend.home', compact('articles', 'most_viewed'));
    }

    public function single($category, $slug)
    {
        $passive_articles = Article::where('status', 0)->get();
        foreach($passive_articles as $passive_article){
            if($slug == $passive_article->slug){
                abort(404, 'Sayfa Bulunamad─▒');
            }
        }

        $category = Category::whereSlug($category)->first() ?? abort(404, 'Kategori Bulunamad─▒');
        $article  = Article::whereSlug($slug)->whereCategoryId($category->id)->first() ?? abort(404, 'Makale Bulunamad─▒');
        $article->increment('hit');
        return view('frontend.single', compact('article'));
    }

    public function category($slug)
    {
        $passive_categories = Category::where('status', 0)->get();
        foreach($passive_categories as $passive_category){
            if($slug == $passive_category->slug){
                abort(404, 'Sayfa Bulunamad─▒');
            }
        }

        $category = Category::whereSlug($slug)->first() ?? abort(404, 'Kategori Bulunamad─▒');
        $articles = Article::where('category_id', $category->id)->where('status', 1)->orderBy('created_at', 'DESC')->paginate(5);
        return view('frontend.category', compact('category', 'articles'));
    }

    public function pages($slug)
    {
        $passive_pages = Page::where('status', 0)->get();
        foreach($passive_pages as $passive_page){
            if($slug == $passive_page->slug){
                abort(404, 'Sayfa Bulunamad─▒');
            }
        }

        $page = Page::whereSlug($slug)->first() ?? abort(404, 'B├Âyle Bir Sayfa Bulunamad─▒');
        return view('frontend.page', compact('page'));
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function contactPost(Request $request)
    {
        $rules    = ['name'    => 'required|min:3',
                     'email'   => 'required|email|',
                     'topic'   => 'required',
                     'message' => 'required|min:15',
        ];
        $validate = Validator::make($request->post(), $rules);
        if($validate->fails()){
            return redirect()->route('contact')->withErrors($validate)->withInput();
        }

        Mail::send([], [], function($message) use ($request){
            $message->from('iletisim@blogger.com', 'Blogger');
            $message->to('dervistprk@gmail.com');
            $message->setBody('<b>Mesaj─▒ G├Ânderen :</b> ' . $request->name . '<br><b>Mesaj─▒ G├Ânderen Mail :</b> ' . $request->email . '<br><b>Mesaj Konusu :</b> '
                              . $request->topic . '<br><b>Mesaj ─░├žeri─či :</b> ' . $request->message . '<br><br><b>Mesaj G├Ânderilme Tarihi :</b> ' . now(), 'text/html');
            $message->subject($request->name . ' ileti┼čimden mesaj g├Ânderdi.');
        });

        $contact          = new Contact();
        $contact->name    = $request->name;
        $contact->email   = $request->email;
        $contact->topic   = $request->topic;
        $contact->message = $request->message;
        $contact->save();
        return redirect()->route('contact')->with('success', 'Mesaj─▒n─▒z taraf─▒m─▒za ba┼čar─▒ ile iletildi. Te┼čekk├╝r ederiz.');
    }
}
