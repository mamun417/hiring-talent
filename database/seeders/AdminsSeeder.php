<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

//        DB::statement("SET foreign_key_checks=0");
//        DB::table('admins')->truncate(); // first delete old data
//        DB::statement("SET foreign_key_checks=1");

        $admin = Admin::create([
            'name' => 'admin',
            'email' => 'admin@test.com',
            'password' => \Hash::make('secret'),
            'type' => null,
        ]);

        $admin->image()->create([
            'url' => 'default.png',
            'base_path' => 'default.png',
            'type' => 'default.png',
        ]);
    }
}
