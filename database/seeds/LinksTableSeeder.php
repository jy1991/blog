<?php

use Illuminate\Database\Seeder;

class LinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            [
                'link_name'=>'后盾网',
                'link_title'=>'培训机构',
                'link_url'=>'http1',
                'link_order'=>'1'
            ]
            ,
            [
                'link_name'=>'后盾论坛',
                'link_title'=>'人人做后盾',
                'link_url'=>'http2',
                'link_order'=>'2'
            ]
        ];

        DB::table('links')->insert($data);
    }
}
