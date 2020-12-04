<?php

namespace Database\Factories;

use App\Models\SupportTicket;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupportTicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SupportTicket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "ref_no" => $this->faker->randomNumber(5),
            "customer_name" =>$this->faker->name,
            "customer_email" => $this->faker->email,
            "customer_phone_number" =>$this->faker->phoneNumber,
            "ticket_description" => $this->faker->sentence(15),
            "ticket_status" => 1
        ];
    }
}
