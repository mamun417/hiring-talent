<?php

namespace Database\Seeders;

use App\Models\Social;
use Illuminate\Database\Seeder;

class SocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $social_name = ['facebook', 'youtube'];
        $social_link = ['https://www.facebook.com/','https://www.youtube.com/'];

        for ($i = 0; $i <= 1; $i++){
            Social::create(
                [
                    'name' => $social_name[$i],
                    'link' => $social_link[$i],
                    'icon' => $social_name[$i],
                    'status' => 1,
                ]
            );
        }
    }
}
