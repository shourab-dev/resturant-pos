<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'title' => "Iftar",
                'slug' => 'iftar',
                'icon' => "placeholder/categories/iftar.jpg",
                'branch' => [1, 2],
            ],
            [
                'title' => "Appetizer",
                'slug' => 'appetizer',
                'icon' => "placeholder/categories/appetizer.jpg",
                'branch' => [1],
            ],
            [
                'title' => "Beverage",
                'slug' => 'beverage',
                'icon' => "placeholder/categories/beverage.jpg",
                'branch' => [1, 2],
            ],
            [
                'title' => "Chinese Food",
                'slug' => 'chinese',
                'icon' => "placeholder/categories/chinese.jpg",
                'branch' => [1, 2],
            ],
            [
                'title' => "Dessert",
                'slug' => 'dessert',
                'icon' => "placeholder/categories/dessert.jpg",
                'branch' => [1, 2],
            ],
            [
                'title' => "Fast Food",
                'slug' => 'fast',
                'icon' => "placeholder/categories/fast.jpg",
                'branch' => [1],
            ],
            [
                'title' => "Indian Food",
                'slug' => 'indian',
                'icon' => "placeholder/categories/indian.jpg",
                'branch' => [1, 2],
            ],
        ];


        foreach ($categories as $category) {
            $newCategory = new Category();
            $newCategory->title = $category['title'];
            $newCategory->slug = $category['slug'];
            $newCategory->icon = $category['icon'];
            $newCategory->save();
            $newCategory->branches()->sync($category['branch']);
        }
    }
}
