<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
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
