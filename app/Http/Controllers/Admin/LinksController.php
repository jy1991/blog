<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Links;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LinksController extends CommonController
{
    //
    public function index()
    {
        $data = Links::orderBy('link_order','asc')->get();
        return view('admin.links.index', compact('data'));
    }

    public function changeOrder()
    {
        $input = Input::all();
        $link = Links::find($input['link_id']);
        $link->link_order = $input['link_order'];
        $res = $link->update();

        if($res)
        {
            $data = ['status'=>1, 'msg'=>'链接排序更新成功'];
        }
        else
        {
            $data = ['status'=>0, 'msg'=>'链接排序更新失败'];
        }

        return $data;

    }

    // delete admin/links/{link_id}
    public function destroy($link_id)
    {
        $res = Links::where('link_id', $link_id)->delete();
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

    // get admin/links/create
    public function create()
    {
        return view('admin.links.add');
    }

    // post admin/links
    public function store()
    {
        $input = Input::except('_token');

        $rules = [ 'link_name' => 'required'];

        $message = [ 'link_name.required' => '链接名称不能为空'];

        $validator = Validator::make($input, $rules, $message);

        if($validator->passes())
        {
            $res = Links::create($input);

            if($res)
            {
                return redirect('admin/links');
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

    // put/patch admin/category/{category}
    public function update($link_id)
    {
        $input = Input::except('_token','_method');
        $res = Links::where('link_id',$link_id)->update($input);

        if($res)
        {
            return redirect('admin/links');
        }
        else
        {
            return back()->with('errors','更新失败');
        }
    }

    // get admin/category/{category}
    public function edit($link_id)
    {
        $field = Links::find($link_id);
        $data = [];
        return view('admin.links.edit',compact('field','data'));
    }



}
