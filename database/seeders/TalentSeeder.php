<?php

namespace Database\Seeders;


use App\Models\Talent;
use Faker\Factory;
use Illuminate\Database\Seeder;

class TalentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Talent::factory()->count(100)->create()->each(function (Talent $talent){
            $faker = Factory::create();
            for ($i = 0; $i <= random_int(0,4); $i++){
                $talent->images()->create([
                    'url' => $faker->imageUrl(500,500),
                ]);
            }
        });
    }
}
