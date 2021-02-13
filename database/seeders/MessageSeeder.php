<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Spatie\Permission\Models\Permission;


class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Message::factory()->count(20)->create();

        $permissions = [
            'message delete',
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
