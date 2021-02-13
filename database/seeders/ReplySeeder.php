<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class ReplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Reply::factory()->count(60)->create();

        $permissions = [
            'reply',
            'reply delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => 'message' . ' ' . $permission,
                'module_name' => 'message',
                'guard_name' => 'admin',
            ]);
        }
    }
}
