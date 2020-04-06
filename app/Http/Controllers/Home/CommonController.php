<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Navs;
use App\Http\Model\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class CommonController extends Controller
{
    //
    public function __construct()
    {
        $navs = Navs::all();

        View::share('navs', $navs);

//        //点击率最高的文章
//        $hot = Article::orderBy('art_view','desc')->take(5)->get();
        View::share('hot', []);
//        //时间
//        $date = Article::orderBy('art_time','desc')->paginate(5);
        View::share('date', []);
//        //友情链接
//        $links = Links::orderBy('link_order','asc')->get();
        View::share('links', []);
//        //文章
//        $article = Article::orderBy('art_order','asc')->get();
        View::share('article', []);
    }
}
