<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Book;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<8;$i++){
            $faker = Faker::create();
            $book = new Book;
            $book->title = rtrim($faker->sentence(rand(1,4)), '.');
            $book->author_id = rand(1,4);
            $book->description = $faker->sentence(rand(16,28));
            while(1){
                $randIBSN = str_pad(rand(0,9999999999),10,'0',STR_PAD_LEFT);
                if(Book::where('ISBN',$randIBSN)->first()==null){
                    $book->ISBN = $randIBSN;
                    break;
                }
            }
            $book->save();
        }
    }
}
