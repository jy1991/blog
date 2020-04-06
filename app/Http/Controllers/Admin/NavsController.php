<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Navs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class NavsController extends CommonController
{
    //
    public function index()
    {
        $data = Navs::orderBy('nav_order','asc')->get();
        return view('admin.navs.index', compact('data'));
    }

    public function changeOrder()
    {
        $input = Input::all();
        $nav = Navs::find($input['nav_id']);
        $nav->nav_order = $input['nav_order'];
        $res = $nav->update();

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

    // delete admin/nav/{nav_id}
    public function destroy($nav_id)
    {
        $res = Navs::where('nav_id', $nav_id)->delete();
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

    // get admin/nav/create
    public function create()
    {
        return view('admin.navs.add');
    }

    // post admin/nav
    public function store()
    {
        $input = Input::except('_token');

        $rules = [ 'nav_name' => 'required'];

        $message = [ 'nav_name.required' => '链接名称不能为空'];

        $validator = Validator::make($input, $rules, $message);

        if($validator->passes())
        {
            $res = Navs::create($input);

            if($res)
            {
                return redirect('admin/navs');
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
    public function update($nav_id)
    {
        $input = Input::except('_token','_method');
        $res = Navs::where('nav_id',$nav_id)->update($input);

        if($res)
        {
            return redirect('admin/navs');
        }
        else
        {
            return back()->with('errors','更新失败');
        }
    }

    // get admin/category/{category}
    public function edit($nav_id)
    {
        $field = Navs::find($nav_id);
        $data = [];
        return view('admin.navs.edit',compact('field','data'));
    }



}
