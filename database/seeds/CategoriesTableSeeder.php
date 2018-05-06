<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ["Comedy","Horror","Children","Mystery","Adventure","Sci-fi"];
        foreach($categories as $category){
            $cat = new Category;
            $cat->description = $category;
            $cat->save();
        }
    }
}
