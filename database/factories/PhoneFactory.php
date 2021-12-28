<?php

namespace Database\Factories;

use App\Models\Phone;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhoneFactory extends Factory
{
    protected $model = Phone::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'contact_id' => DB::table('contacts')->inRandomOrder()->first()->id,
            'phone' => $this->faker->unique->phoneNumber,
        ];
    }
}
