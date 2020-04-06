<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ConfigController extends CommonController
{
    //
    public function index()
    {
        $data = Config::orderBy('conf_order','asc')->get();
        return view('admin.config.index', compact('data'));
    }

    public function changeOrder()
    {
        $input = Input::all();
        $conf = Config::find($input['conf_id']);
        $conf->conf_order = $input['conf_order'];
        $res = $conf->update();

        if($res)
        {
            $data = ['status'=>1, 'msg'=>'配置项排序更新成功'];
        }
        else
        {
            $data = ['status'=>0, 'msg'=>'配置项排序更新失败'];
        }

        return $data;

    }

    // delete admin/config/{conf_id}
    public function destroy($conf_id)
    {
        $res = Config::where('conf_id', $conf_id)->delete();
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

    // get admin/config/create
    public function create()
    {
        return view('admin.config.add');
    }

    // post admin/config
    public function store()
    {
        $input = Input::except('_token');

        $rules = [ 'conf_name' => 'required'];

        $message = [ 'conf_name.required' => '配置项名称不能为空'];

        $validator = Validator::make($input, $rules, $message);

        if($validator->passes())
        {
            $res = Config::create($input);

            if($res)
            {
                return redirect('admin/config');
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

    // put/patch admin/config/{config}
    public function update($conf_id)
    {
        $input = Input::except('_token','_method');
        $res = Config::where('conf_id',$conf_id)->update($input);

        if($res)
        {
            return redirect('admin/config');
        }
        else
        {
            return back()->with('errors','更新失败');
        }
    }

    // get admin/config/{config}
    public function edit($conf_id)
    {
        $field = Config::find($conf_id);
        $data = [];
        return view('admin.config.edit',compact('field','data'));
    }

    public function putFile()
    {
        $config = Config::pluck('conf_content', 'conf_name')->all();
        $path = base_path().'\config\web.php';
        $str = '<?php return '.var_export($config, true).';';
        file_put_contents($path, $str);
    }

}
