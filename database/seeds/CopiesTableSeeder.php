<?php

use Illuminate\Database\Seeder;
use App\Copy;
use App\Book;

class CopiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(Book::all() as $book){
            for($i=0;$i<rand(1,4);$i++){
                $copy = new Copy;
                $copy->book_id = $book->id;
                $copy->save();
            }
        }
    }
}
