<?php

namespace Modules\News\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Modules\News\Entities\NewsCategories ;
use Modules\News\Entities\News ;
class NewsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $now = DB::raw('NOW()');
        // DB::statement("ALTER TABLE news_categories AUTO_INCREMENT=1");
        // DB::table('news_categories')->truncate();
        // DB::table('news_categories')->insert([
        //     'id'=> 1,
        //     'name_th' => 'news category name thai',
        //     'name_en' => 'news category name english',
        //     'description_th'=>'news category description thai',
        //     'description_en'=>'news category description english',
        //     'status' =>1,
        //     '_lft' => 1,
        //     '_rgt' => 2,
        //     'created_at'=>$now,
        //     'updated_at'=>$now
        // ]);

        DB::statement("ALTER TABLE news AUTO_INCREMENT=1");
        DB::table('news')->truncate();
        DB::table('news')->insert([
            'id'  => 1,
            'name_th' => 'news name thai',
            'name_en' => 'news name english',
            'description_th' => 'news name thai',
            'description_en' => 'news name english',
            'image'=> 'news_storage_thai.jpg',
            'params'=> 'text',
            'status' =>1,
            'sequence' => 1,
            'author' =>1,
            'publish_at'=>$now,
            'created_at'=>$now,
            'updated_at'=>$now
        ]);
    }
}
