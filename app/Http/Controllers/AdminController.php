<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Author;
use App\Book;
use App\Category;
use App\Copy;

class AdminController extends Controller
{
    private function checkAdmin(){
        if(Auth::id()!=1){
            abort(404);
        }
    }

    public function index(){
        $this->checkAdmin();
        return view("admin.index",[
            "books"=>Book::all()
        ]);
    }

    public function newbook(){
        $this->checkAdmin();
        $authors = Author::all()->pluck("name","id");
        return view("admin.book",[
            "authors"=>$authors
        ]);
    }

    public function editbook(){
        $this->checkAdmin();
        $book_id = \Request::all()["book_id"];
        $authors = Author::all()->pluck("name","id");
        return view("admin.book",[
            "book"=>Book::find($book_id),
            "authors"=>$authors
        ]);
    }

    public function saveBook(){
        $this->checkAdmin();
        if(isset(\Request::all()["id"])){
            try {
                $book=Book::find(\Request::all()["id"]);
            }
            catch(\Exception $e){
                return $e->getMessage();
            }
        }
        else{
            $book = new Book;
        }
        $book->title = \Request::all()["title"];
        $book->ISBN = \Request::all()["isbn"];
        $book->author_id = \Request::all()["author_id"];
        $book->description = \Request::all()["description"];
        try{
            $book->save();
        }
        catch(\Exception $e){
            return $e->getMessage();
        }
        return redirect("/admin?message=Successfully added/modify book.");
    }

    public function addcategory(){
        $this->checkAdmin();
        return view("admin.category");
    }

    public function savecategory(){
        $this->checkAdmin();
        $cat = new Category;
        $cat->description = \Request::all()["description"];
        try{
            $cat->save();
        }
        catch(\Exception $e){
            return $e->getMessage();
        }
        return redirect("/admin?message=Successfully added new category.");
    }

    public function addauthor(){
        $this->checkAdmin();
        return view("admin.author");
    }

    public function saveauthor(){
        $this->checkAdmin();
        $author = new Author;
        $author->name = \Request::all()["name"];
        $author->biography = \Request::all()["biography"];
        try{
            $author->save();
        }
        catch(\Exception $e){
            return $e->getMessage();
        }
        return redirect("/admin?message=Successfully added new author.");
    }

    public function addcopy(){
        $this->checkAdmin();
        return view("admin.copy",[
            "book" => Book::find(\Request::all()["book_id"])
        ]);
    }

    public function savecopy(){
        $this->checkAdmin();
        $copy = new Copy;
        $copy->book_id = \Request::all()["book_id"];
        $copy->date_purchased = \Request::all()["date_purchased"];
        try{
            $copy->save();
        }
        catch(\Exception $e){
            return $e->getMessage();
        }
        return redirect("/admin?message=Successfully added new book copy.");
    }

    public function bookcategory(){
        $this->checkAdmin();
        $selectedcategories = Book::find(\Request::all()["book_id"])->categories->pluck("id");
        return view("admin.bookcategory",[
            "book" => Book::find(\Request::all()["book_id"]),
            "selectedcategories" => $selectedcategories,
            "categories" => Category::all()->pluck("description","id")
        ]);
    }

    public function savebookcategory(){
        $this->checkAdmin();
        $book = Book::find(\Request::all()["book_id"]);
        $book->categories()->sync(\Request::all()["categories"]);
        $book->save();
        return redirect("/admin?message=Successfully updated the categories of ".$book->title.".");
    }
}
