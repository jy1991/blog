<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Article;
use App\Http\Model\Category;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ArticleController extends CommonController
{
    // get admin/article
    public function index()
    {
        $data = Article::paginate(1);

        return view('admin.article.index', compact('data'));
    }

    // post admin/article
    public function store()
    {
        $input = Input::except('_token','file_upload');
        $input['art_time'] = time();

        $rules = [ 'art_title' => 'required'];

        $message = [ 'art_title.required' => '文章名称不能为空'];

        $validator = Validator::make($input, $rules, $message);

        if($validator->passes())
        {
            $res = Article::create($input);

            if($res)
            {
                return redirect('admin/article');
            }
            else
            {
                return back()->with('errors','添加失败');
            }
        }
        else
        {
            return back()->withErrors($validator);
        }

    }

    // get admin/article/create
    public function create()
    {
        $data = (new Category())->tree((new Category())->all()) ;
        return view('admin.article.add', compact('data'));
    }

    // get admin/article/{article}
    public function show()
    {

    }

    // delete admin/article/{article}
    public function destroy($article_id)
    {
        $res = article::where('article_id', $article_id)->delete();
        article::where('article_pid',$article_id)->update('article_id', 0 );
        if($res)
        {
            $data = ['status'=>1, 'msg'=>'删除成功'];
        }
        else
        {
            $data = ['status'=>0, 'msg'=>'删除失败'];
        }

        return $data;
    }

    // put/patch admin/article/{article}
    public function update($art_id)
    {
        $input = Input::except('_token','_method','file_upload');
        $res = article::where('art_id',$art_id)->update($input);

        if($res)
        {
            return redirect('admin/article');
        }
        else
        {
            return back()->with('errors','更新失败');
        }
    }

    // get admin/article/{article}
    public function edit($art_id)
    {
        $field = article::find($art_id);
        $data =  category::where('cate_pid','=','0')->get();
        return view('admin.article.edit',compact('field','data'));
    }

}
