<?php

namespace Database\Factories;

use App\Models\Email;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmailFactory extends Factory
{
    protected $model = Email::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'contact_id' => DB::table('contacts')->inRandomOrder()->first()->id,
            'email' => $this->faker->unique->email,
        ];
    }
}
