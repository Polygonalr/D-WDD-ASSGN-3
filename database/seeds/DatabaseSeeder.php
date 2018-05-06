<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Schema::disableForeignKeyConstraints();
        DB::table("users")->truncate();
        DB::table("authors")->truncate();
        DB::table("books")->truncate();
        DB::table("categories")->truncate();
        DB::table("book_category")->truncate();
        DB::table("copies")->truncate();
        DB::table("user_copy_logs")->truncate();
        $this->call(UsersTableSeeder::class);
        $this->call(AuthorsTableSeeder::class);
        $this->call(BooksTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(BookCategoryTableSeeder::class);
        $this->call(CopiesTableSeeder::class);
        Schema::enableForeignKeyConstraints();
    }

    public function cleanDatabase()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        foreach ($this->tables as $table) {
            DB::table($table)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
