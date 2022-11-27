<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

class UserDatabaseSeeder extends Seeder
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
        DB::statement("ALTER TABLE users AUTO_INCREMENT=1");
        DB::table('users')->truncate();
        DB::table('users')->insert([
            'id'=>1,
            'name'=>'Superadmin',
            'group_id'=>1,
            'username' => 'admin',
            'email'    => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'avatar'   =>'',
            'role'   =>'{"user":{"user":{"all":"all","view":"view","add":"add","edit":"edit","delete":"delete"},"group":{"all":"all","view":"view","add":"add","edit":"edit","delete":"delete"}}}',
            'locale'   =>'th',
            'status'   =>1,
            'api_enable'   =>1,
            'last_logedin_at'=>$now,
            'remember_token'=>'',
            'created_at'=>$now,
            'updated_at'=>$now
        ]);
        
        DB::statement("ALTER TABLE user_groups AUTO_INCREMENT=1");
        DB::table('user_groups')->truncate();
        DB::table('user_groups')->insert([
            'id'=> 1,
            'name'=> 'Superadmin Group',
            'description'=>'Superadmin group',
            'default_role'=>'',
            'status'=>1,
            'created_at'=>$now,
            'updated_at'=>$now
        ]);


    }
}
