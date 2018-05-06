<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Author;
use App\Copy;
use App\UserCopyLog;
use App\Category;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Carbon\Carbon;

class HomeController extends Controller
{

    private function DateStrDaysDiff($d1,$d2){
        $datediff = date_diff(date_create_from_format('Y-m-d',date_create_from_format('Y-m-d H:i:s', $d1)->format('Y-m-d')),date_create_from_format('Y-m-d',date_create_from_format('Y-m-d H:i:s', $d2)->format('Y-m-d')));
        return $datediff->days;
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home',[
            "newBooks" => Book::orderBy("id","desc")->take(4)->get(),
        ]);
    }

    public function bookinfo($id){
        $query = Book::find($id);
        if($query==null){
            return $this->error("Invalid book id given.");
        }
        $copies = Copy::where("book_id",$id)->get();
        for($i=0;$i<sizeof($copies);$i++){
            $lastLog = UserCopyLog::where("copy_id",$copies[$i]->id)->orderBy("id","desc")->first();
            if($lastLog!=null && $lastLog->date_returned==null){ // this copy has been borrowed
                if(Auth::check() && $lastLog->user_id == Auth::id()){
                    $copies[$i]->mine = true;
                    $copies[$i]->duedate = date("Y-m-d", strtotime($copies[$i]->date_borrowed ." + 14 days"));
                }
                else{
                    $copies[$i]->mine=false;
                }
                $copies[$i]->borrowed=true;
            }
            else{
                $copies[$i]->borrowed=false;
            }
        }
        return view('bookinfo',[
            "book" => $query,
            "copies" => $copies
        ]);
    }

    public function authorinfo($id){
        $query = Author::find($id);
        if($query==null){
            return $this->error("Invalid author id given.");
        }
        $books = Book::where("author_id",$id);
        return view('authorinfo',[
            "author" => $query,
            "books" => $books->get()
        ]);
    }

    public function booksFromCategory($categoryName){
        $query = Category::where("description", $categoryName)->first();
        if($query==null){
            return $this->error("Invalid category name.");
        }
        $books = Book::whereHas('categories',function ($query) use ($categoryName){
            $query->where("description",$categoryName);
        })->paginate("5");
        return view('category',[
            "category"=>$query,
            "books"=>$books
        ]);
    }

    public function borrowBook(){
        $copy_id = \Request::all()["copy_id"];
        $user_id = Auth::id();
        if(sizeof(Copy::find($copy_id))==0){
            return $this->error("Attempted to borrow an invalid book.");
        }
        $noOfBooksBorrowed = sizeof(UserCopyLog::where("user_id","=",$user_id)->whereNull("date_returned")->get());
        $lastCopyBorrowLog = UserCopyLog::where("copy_id",$copy_id)->orderBy("id","desc")->first();
        $finesNotPaidYet = (sizeof(UserCopyLog::where("user_id",$user_id)->where("fines_paid",0)->get())>0);
        $copiesOnLoan = UserCopyLog::where("user_id","=",$user_id)->whereNull("date_returned")->get();
        $pastDueDate = false;
        foreach($copiesOnLoan as $log){
            if($this->DateStrDaysDiff($log->date_borrowed,date("Y-m-d H:i:s"))>14){
                $pastDueDate=true;
            }
        }
        if($noOfBooksBorrowed>=4){
            //deny borrow, too many books borrowed
            return redirect('/book/'.Copy::find($copy_id)->book->id."?error=You had borrowed too many books (4 books)! Return them first!");
        }
        else if($lastCopyBorrowLog!=null && $lastCopyBorrowLog->date_returned==null){
            //error: book already borrowed
            return redirect('/book/'.Copy::find($copy_id)->book->id."?error=This book is already borrowed!");
        }
        else if($pastDueDate){
            //if there are borrowed books past due date
            return redirect('/book/'.Copy::find($copy_id)->book->id."?error=You have overdue books that has yet to be returned. Return them and pay your fines before you can borrow more.");
        }
        else if($finesNotPaidYet){
            //if there are outstanding fines to be paid
            return redirect('/book/'.Copy::find($copy_id)->book->id."?error=You have outstanding fines. Pay them before you can borrow more books!");
        }
        else{ // allow borrow, process.
            $log = new UserCopyLog;
            $log->copy_id = $copy_id;
            $log->user_id = $user_id;
            $log->save();
        }
        return redirect('/book/'.Copy::find($copy_id)->book->id."?success=Successfully borrowed book.");
    }

    public function returnbook(){
        $copy_id = \Request::all()["copy_id"];
        $prevURL = \Request::all()["prevURL"];
        $user_id = Auth::id();
        $lastCopyBorrowLog = UserCopyLog::where("copy_id",$copy_id)->orderBy("id","desc")->first();
        if($lastCopyBorrowLog->user_id == $user_id && $lastCopyBorrowLog->date_returned==NULL){
            $lastCopyBorrowLog->date_returned = date("Y-m-d H:i:s");
            if($this->DateStrDaysDiff($lastCopyBorrowLog->date_returned,$lastCopyBorrowLog->date_borrowed) > 14){
                $lastCopyBorrowLog->fines_paid = false;
            }
            $lastCopyBorrowLog->save();
            return redirect($prevURL."?success=Successfully returned book.");
        }
    }

    public function categories(){
        $query = Category::all();
        return view("displaycategories",[
            "categories" => $query
        ]);
    }

    public function search(){
        return view("search", [
            "bannerMessage"=>"What shall we search for today?"
        ]);
    }

    public function searchResults($searchType,$searchField){
        if($searchType == "title"){
            $books = Book::where("title","like","%".$searchField."%")->paginate(5);
        }
        else if($searchType == "isbn"){
            $books = Book::where("ISBN","like","%".$searchField."%")->paginate(5);
        }
        else{
            dd("Invalid arguments.");
        }
        return view("search", [
            "bannerMessage"=>"Displaying results for ".$searchField.".",
            "searchType" => $searchType,
            "searchField" => $searchField,
            "books" => $books
        ]);
    }

    public function error($message){
        //$message = \Request::all()["message"]??"nil";
        return view("error/generic",[
            "message"=>$message
        ]);
    }
}
