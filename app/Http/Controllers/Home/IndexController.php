<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Article;
use App\Http\Model\Links;
use App\Http\Model\Navs;

class IndexController extends CommonController
{
    //
    public function index()
    {
        return view('home/index', compact('navs','hot','date','links'));
    }

    public function cate()
    {
        return view('home/list', compact('navs'));
    }

    public function article($art_id)
    {
        $field = Article::join('category','article,cate_id','=','category.cate_id')->where('art_id',$art_id)->get();

        $article['pre'] = Article::where('art_id', '<', $art_id)->orderBy('art_id','desc')->first();
        $article['next'] = Article::where('art_id', '<', $art_id)->orderBy('art_id','asc')->first();
        return view('home/new', compact('field'));
    }

}
