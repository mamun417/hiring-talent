<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        DB::table('roles')->truncate(); // first delete old data
        DB::statement("SET foreign_key_checks=1");

        $role = Role::create([
            'name' => 'admin',
            'guard_name' => 'admin'
        ]);

        $admin = Admin::where('id', 1)->first();
        if ($admin) {
            $admin->assignRole($role);
        }
    }
}
