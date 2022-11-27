<?php

namespace Modules\Menu\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MenuDatabaseSeeder extends Seeder
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
        DB::statement("ALTER TABLE menu AUTO_INCREMENT=1");
        DB::table('menu')->truncate();
        DB::table('menu')->insert([
            'id' => 1,
            'name_th' => 'หน้าหลัก',
            'name_en' => 'Home',
            'slug_th'    => 'home',
            'slug_en'    => 'home',
            'sequence'   => 1,
            'status'   => 1,
            'type'   => 1,
            'created_at' => $now,
            'updated_at' => $now
        ]);

        DB::table('menu')->insert([
            'id' => 2,
            'name_th' => 'เกี่ยวกับเรา',
            'name_en' => 'About us',
            'slug_th'    => 'about',
            'slug_en'    => 'about',
            'sequence'   => 2,
            'status'   => 1,
            'type'   => 1,
            'created_at' => $now,
            'updated_at' => $now
        ]);
        
        DB::table('menu')->insert([
            'id' => 3,
            'name_th' => 'บริการ',
            'name_en' => 'Services',
            'slug_th'    => 'services',
            'slug_en'    => 'services',
            'sequence'   => 3,
            'status'   => 1,
            'type'   => 1,
            'created_at' => $now,
            'updated_at' => $now
        ]);
        
        DB::table('menu')->insert([
            'id' => 4,
            'name_th' => 'ข่าวอัพเดท',
            'name_en' => 'News Updates',
            'slug_th'    => 'news',
            'slug_en'    => 'news',
            'sequence'   => 4,
            'status'   => 1,
            'type'   => 1,
            'created_at' => $now,
            'updated_at' => $now
        ]);

        DB::table('menu')->insert([
            'id' => 5,
            'name_th' => 'ติดต่อเรา',
            'name_en' => 'Contact Us',
            'slug_th'    => 'contact',
            'slug_en'    => 'contact',
            'sequence'   => 5,
            'status'   => 1,
            'type'   => 1,
            'created_at' => $now,
            'updated_at' => $now
        ]);

        DB::table('menu')->insert([
            'id' => 6,
            'name_th' => 'หน้าหลัก',
            'name_en' => 'Home',
            'slug_th'    => 'home',
            'slug_en'    => 'home',
            'sequence'   => 6,
            'status'   => 1,
            'type'   => 2,
            'created_at' => $now,
            'updated_at' => $now
        ]);

        DB::table('menu')->insert([
            'id' => 7,
            'name_th' => 'เกี่ยวกับเรา',
            'name_en' => 'About us',
            'slug_th'    => 'about',
            'slug_en'    => 'about',
            'sequence'   => 7,
            'status'   => 1,
            'type'   => 2,
            'created_at' => $now,
            'updated_at' => $now
        ]);
        
        DB::table('menu')->insert([
            'id' => 8,
            'name_th' => 'บริการ',
            'name_en' => 'Services',
            'slug_th'    => 'services',
            'slug_en'    => 'services',
            'sequence'   => 8,
            'status'   => 1,
            'type'   => 2,
            'created_at' => $now,
            'updated_at' => $now
        ]);
        
        DB::table('menu')->insert([
            'id' => 9,
            'name_th' => 'ข่าวสาร',
            'name_en' => 'News Updates',
            'slug_th'    => 'news',
            'slug_en'    => 'news',
            'sequence'   => 9,
            'status'   => 1,
            'type'   => 2,
            'created_at' => $now,
            'updated_at' => $now
        ]);

        DB::table('menu')->insert([
            'id' => 10,
            'name_th' => 'ติดต่อเรา',
            'name_en' => 'Contact Us',
            'slug_th'    => 'contact',
            'slug_en'    => 'contact',
            'sequence'   => 10,
            'status'   => 1,
            'type'   => 2,
            'created_at' => $now,
            'updated_at' => $now
        ]);
       
    }
}
