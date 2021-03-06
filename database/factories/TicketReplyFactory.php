<?php

namespace Database\Factories;

use App\Models\SupportTicket;
use App\Models\TicketReply;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketReplyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TicketReply::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "ticket_id"=> SupportTicket::factory(),
            "agent_id" => $this->faker->randomElements([1,2,3]),
            "reply_description" => $this->faker->sentence(6)
        ];
    }
}
