<?php

namespace Modules\Banner\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BannerDatabaseSeeder extends Seeder
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

        DB::statement("ALTER TABLE banner AUTO_INCREMENT=1");
        DB::table('banner')->truncate();
        DB::table('banner')->insert([
            'id'  => 1,
            'menu_id'  => 1,
            'name_th' => 'banner name thai',
            'name_en' => 'banner name english',
            'description_th' => 'banner description thai',
            'description_en' => 'banner description english',
            'image' => 'banner_storage_thai.jpg',
            'sequence' => 1,
            'status' => 1,
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
