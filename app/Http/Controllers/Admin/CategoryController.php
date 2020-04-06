<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\IpUtils;

class CategoryController extends CommonController
{
    // get admin/category
    public function index()
    {
        $categorys = (new Category())->orderBy('cate_order', 'asc')->get();
        $data = $this->getTree($categorys);
        return view('admin.category.index')->with('data', $data);
    }

    public function changeOrder()
    {
        $input = Input::all();
        $cate = Category::find($input['cate_id']);
        $cate->cate_order = $input['cate_order'];
        $res = $cate->update();

        if($res)
        {
            $data = ['status'=>1, 'msg'=>'分类排序更新成功'];
        }
        else
        {
            $data = ['status'=>0, 'msg'=>'分类排序更新失败'];
        }

        return $data;

    }

    public function getTree($data)
    {
        $arr = [];

        foreach($data as $v)
        {
            if($v->cate_pid == 0)
            {
                $arr[] = $v;
                foreach($data as &$n)
                {
                    if($n->cate_pid == $v->cate_id)
                    {
                        $n['cate_name'] = '----'.$n['cate_name'];
                        $arr[] = $n;
                    }
                }
            }
        }

        return $arr;
    }

    // post admin/category
    public function store()
    {
        $input = Input::except('_token');

        $rules = [ 'cate_name' => 'required'];

        $message = [ 'cate_name.required' => '分类名称不能为空'];

        $validator = Validator::make($input, $rules, $message);

        if($validator->passes())
        {
            $res = Category::create($input);

            if($res)
            {
                return redirect('admin/category');
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

    // get admin/category/create
    public function create()
    {
        $data = Category::where('cate_pid','=','0')->get();
        return view('admin.category.add', compact('data'));
    }

    // get admin/category/{category}
    public function show()
    {

    }

    // delete admin/category/{category}
    public function destroy($cate_id)
    {
        $res = Category::where('cate_id', $cate_id)->delete();
        Category::where('cate_pid',$cate_id)->update('cate_id', 0 );
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

    // put/patch admin/category/{category}
    public function update($cate_id)
    {
        $input = Input::except('_token','_method');
        $res = Category::where('cate_id',$cate_id)->update($input);

        if($res)
        {
            return redirect('admin/category');
        }
        else
        {
            return back()->with('errors','更新失败');
        }
    }

    // get admin/category/{category}
    public function edit($cate_id)
    {
        $field = Category::find($cate_id);
        $data = Category::where('cate_pid','=','0')->get();
        return view('admin.category.edit',compact('field','data'));
    }

}
