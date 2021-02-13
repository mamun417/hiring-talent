<?php

namespace Database\Factories;

use App\Models\Message;
use App\Models\Reply;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReplyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reply::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'message_id'   => Message::select('id')->inRandomOrder()->first(),
            'reply_email'     => $this->faker->email,
            'reply_subject'     => "Thanks",
            'reply_message' => $this->faker->paragraph,
            'created_by' => 1,
        ];
    }
}
