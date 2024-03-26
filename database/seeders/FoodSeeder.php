<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Food;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        $foods = [
            [
                'name' => "Biriyani",
                'price' => 350,
                'image' => "placeholder/foods/biriyani.jpg",
                'categories' => [1, $faker->numberBetween(1, Category::count())],
            ],
            [
                'name' => "cake",
                'price' => 150,
                'image' => "placeholder/foods/cake.jpg",
                'categories' => [1, $faker->numberBetween(1, Category::count())],
            ],
            [
                'name' => "capacino",
                'price' => 200,
                'image' => "placeholder/foods/capacino.jpg",
                'categories' => [1, $faker->numberBetween(1, Category::count())],
            ],
            [
                'name' => "chaomin",
                'price' => 250,
                'image' => "placeholder/foods/chaomin.jpg",
                'categories' => [1, $faker->numberBetween(1, Category::count())],
            ],
            [
                'name' => "coke",
                'price' => 50,
                'image' => "placeholder/foods/coke.jpg",
                'categories' => [1, $faker->numberBetween(1, Category::count())],
            ],
            [
                'name' => "cookies",
                'price' => 100,
                'image' => "placeholder/foods/cookies.jpg",
                'categories' => [1, $faker->numberBetween(1, Category::count())],
            ],
            [
                'name' => "fries",
                'price' => 110,
                'image' => "placeholder/foods/fries.jpg",
                'categories' => [1, $faker->numberBetween(1, Category::count())],
            ],
            [
                'name' => "haleem",
                'price' => 160,
                'image' => "placeholder/foods/haleem.jpg",
                'categories' => [1, $faker->numberBetween(1, Category::count())],
            ],
            [
                'name' => "ice cream",
                'price' => 150,
                'image' => "placeholder/foods/ice-cream.jpg",
                'categories' => [1, $faker->numberBetween(1, Category::count())],
            ],
            [
                'name' => "kabab",
                'price' => 220,
                'image' => "placeholder/foods/kabab.jpg",
                'categories' => [1, $faker->numberBetween(1, Category::count())],
            ],
            [
                'name' => "latte",
                'price' => 220,
                'image' => "placeholder/foods/latte.jpg",
                'categories' => [1, $faker->numberBetween(1, Category::count())],
            ],
            [
                'name' => "pasta",
                'price' => 220,
                'image' => "placeholder/foods/pasta.jpg",
                'categories' => [1, $faker->numberBetween(1, Category::count())],
            ],
            [
                'name' => "pizza",
                'price' => 220,
                'image' => "placeholder/foods/pizza.jpg",
                'categories' => [1, $faker->numberBetween(1, Category::count())],
            ],
            [
                'name' => "pocket cake",
                'price' => 220,
                'image' => "placeholder/foods/pocket-cake.jpg",
                'categories' => [1, $faker->numberBetween(1, Category::count())],
            ],
            [
                'name' => "porota",
                'price' => 220,
                'image' => "placeholder/foods/porota.jpg",
                'categories' => [1, $faker->numberBetween(1, Category::count())],
            ],
            [
                'name' => "sandwich",
                'price' => 220,
                'image' => "placeholder/foods/sandwich.jpg",
                'categories' => [1, $faker->numberBetween(1, Category::count())],
            ],

        ];

        foreach ($foods as $food) {
            $foodSeeder = new Food();
            $foodSeeder->name = $food['name'];
            $foodSeeder->price = $food['price'];
            $foodSeeder->image = $food['image'];
            $foodSeeder->save();
            $foodSeeder->categories()->sync($food['categories']);
        }
    }
}
