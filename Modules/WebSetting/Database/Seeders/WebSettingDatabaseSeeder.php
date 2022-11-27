<?php

namespace Modules\WebSetting\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class WebSettingDatabaseSeeder extends Seeder
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
        DB::statement("ALTER TABLE websetting AUTO_INCREMENT=1");
        DB::table('websetting')->truncate();
        DB::table('websetting')->insert([
            'id'  => 1,
            'companyname_th' => 'companyname',
            'companyname_en' => 'companyname',
            'created_at'=>$now,
            'updated_at'=>$now
        ]);
    }
}
