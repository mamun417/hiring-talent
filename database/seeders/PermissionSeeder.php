<?php

namespace Database\Seeders;

use App\Http\Controllers\Helpers\PermissionModule;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $modules = PermissionModule::modules();

        foreach ($modules as $module) {
            foreach ($module['permissions'] as $permission) {
                Permission::create([
                    'name' => $module['name'] . ' ' . $permission,
                    'module_name' => $module['name'],
                    'guard_name' => 'admin',
                ]);
            }
        }
    }
}
