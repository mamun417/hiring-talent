<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminsSeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
//            SettingSeeder::class,
//            SlidersSeeder::class,
//            UserTableSeeder::class,
//            TalentSeeder::class,
//            ContactSeeder::class,
//            SocialSeeder::class,
//            SliderBgSeeder::class,
        ]);
    }
}
