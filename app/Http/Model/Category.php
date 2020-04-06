<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'cate_id';
    public $timestamps = false;
    protected $guarded = [];

    public static function tree($data)
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
}
