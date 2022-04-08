<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Test;
use Illuminate\Encryption\Encrypter;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Test>
 */
class TestFactory extends Factory
{
    protected $model = Test::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        #Encrypter
        $db_key  = config('app.db_key');
        $fromKey = base64_decode($db_key);
        $cipher = "aes-256-gcm";
        $this->encrypter = new Encrypter($fromKey, $cipher);

        return [
            'title' => $this->faker->name,
            'description' => $this->faker->paragraph,
        ];
    }
}
