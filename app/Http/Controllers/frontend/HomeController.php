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
    public function __construct(){
        if(Config::find(1)->active == 0){
            return redirect()->to('bakimdayiz')->send();
        }

        view()->share('pages', Page::where('status', 1)->orderBy('order')->get());
        view()->share('categories', Category::orderBy('name')->where('status', 1)->get());
        view()->share('config', Config::find(1));
    }

    public function index(){
        $data['articles'] = Article::with('category')->where('status', 1)->whereHas('category', function($query){
            $query->where('status', 1);
        })->orderBy('created_at', 'DESC')->paginate(10);
        $data['articles']->withPath(url('sayfa'));
        return view('frontend.home')->with($data);
    }

    public function single($category, $slug){
        $passive_articles = Article::where('status', 0)->get();
        foreach($passive_articles as $passive_article){
            if($slug == $passive_article->slug){
                abort(404, 'Sayfa Bulunamadı');
            }
        }


        $category = Category::whereSlug($category)->first() ?? abort(404, 'Kategori Bulunamadı');
        $article  = Article::whereSlug($slug)->whereCategoryId($category->id)->first() ?? abort(404, 'Makale Bulunamadı');
        $article->increment('hit');
        $data['article'] = $article;
        return view('frontend.single')->with($data);
    }

    public function category($slug){
        $passive_categories = Category::where('status', 0)->get();
        foreach($passive_categories as $passive_category){
            if($slug == $passive_category->slug){
                abort(404, 'Sayfa Bulunamadı');
            }
        }

        $category         = Category::whereSlug($slug)->first() ?? abort(404, 'Kategori Bulunamadı');
        $data['category'] = $category;
        $data['articles'] = Article::where('category_id', $category->id)->where('status', 1)->orderBy('created_at', 'DESC')->paginate(5);
        return view('frontend.category')->with($data);
    }

    public function pages($slug){
        $passive_pages = Page::where('status', 0)->get();
        foreach($passive_pages as $passive_page){
            if($slug == $passive_page->slug){
                abort(404, 'Sayfa Bulunamadı');
            }
        }

        $page         = Page::whereSlug($slug)->first() ?? abort(404, 'Böyle Bir Sayfa Bulunamadı');
        $data['page'] = $page;
        return view('frontend.page')->with($data);
    }

    public function contact(){
        return view('frontend.contact');
    }

    public function contactPost(Request $request){
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
            $message->setBody('<b>Mesajı Gönderen :</b> ' . $request->name . '<br><b>Mesajı Gönderen Mail :</b> ' . $request->email . '<br><b>Mesaj Konusu :</b> '
                              . $request->topic . '<br><b>Mesaj İçeriği :</b> ' . $request->message . '<br><br><b>Mesaj Gönderilme Tarihi :</b> ' . now(), 'text/html');
            $message->subject($request->name . ' iletişimden mesaj gönderdi.');
        });

        $contact          = new Contact();
        $contact->name    = $request->name;
        $contact->email   = $request->email;
        $contact->topic   = $request->topic;
        $contact->message = $request->message;
        $contact->save();
        return redirect()->route('contact')->with('success', 'Mesajınız tarafımıza başarı ile iletildi. Teşekkür ederiz.');
    }
}
