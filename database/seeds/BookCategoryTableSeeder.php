<?php

use Illuminate\Database\Seeder;
use App\Book;
use App\Category;

class BookCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(Book::all() as $book){
            $categories = array(1,2,3,4,5,6);
            $rand = rand(1,3);
            if($rand==1){
                $keys = array(array_rand($categories, 1));
            }
            else{
                $keys = array_rand($categories, $rand);
            }
            $bookcat = array();
            foreach($keys as $key){
                array_push($bookcat,$categories[$key]);
            }
            $book->categories()->sync($bookcat);
        }
    }
}
