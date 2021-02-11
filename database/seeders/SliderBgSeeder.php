<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class SliderBgSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = [
            [
                'name' => 'background_image',
                'permissions' => [
                    'create',
                    'edit',
                    'delete',
                ]
            ]
        ];

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
