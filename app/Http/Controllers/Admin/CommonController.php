<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\Input;

class CommonController extends Controller
{
    //上传
    public function upload()
    {
        $file = Input::file('Filedata');
        if($file->isValid())
        {
            $realPath = $file->getRealPath();
            $extension = $file->getCilentOriginalExtension();
            $newName = date('YmdHis').mt_rand(100,999).'.'.$extension;
            $path = $file->move(base_path().'/uploads', $newName);

            return 'uploads'.$newName;
        }
    }
}
