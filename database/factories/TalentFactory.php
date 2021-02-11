<?php

namespace Database\Factories;

use App\Models\Talent;
use Illuminate\Database\Eloquent\Factories\Factory;

class TalentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Talent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'talent_name' => $this->faker->word,
            'parent_name' => $this->faker->name,
            'email' => $this->faker->email,
            'phone' => $this->faker-> phoneNumber,
            'date_of_birth' => $this->faker->date('Y-m-d'),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'eye_color' => $this->faker->colorName,
            'hair_color' => $this->faker-> colorName,
            'height' => $this->faker->randomDigit,
            'weight' => $this->faker->randomDigit,
            'shirt_size' => $this->faker->randomDigit,
            'pant_size' => $this->faker->randomDigit,
            'shoe_size' => $this->faker->randomDigit,
            'ethnicity_one' => $this->faker->word,
            'ethnicity_two' => $this->faker->word,
            'mail_address' => $this->faker->companyEmail,
            'subject' => $this->faker->word,
            'referred_by' => $this->faker->randomDigit,
            'message' => $this->faker->paragraph,
            'la_casting_profile_link' => $this->faker->url,
            'actor_access_profile_link' => $this->faker->url,
            'website' => $this->faker->url,
            'imdb_page' => $this->faker->url,
            'represent_agency' => $this->faker->text,
        ];
    }
}
