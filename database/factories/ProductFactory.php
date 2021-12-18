<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(){
		return [
		'title' => $this->faker->unique()->words(4,true),
		'code' => $this->faker->unique()->numerify('########'),
		'description' => $this->faker->realText(150),
		'price' => $this->faker->randomFloat (2,5,250),
		'image' => 'defaultImage.jpg',
		];
	}
}
