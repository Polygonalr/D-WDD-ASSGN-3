<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\UserCopyLog;
use Illuminate\Support\Facades\Auth;
use App\Book;

class UserController extends Controller
{
    private function DateStrDaysDiff($d1,$d2){
        $datediff = date_diff(date_create_from_format('Y-m-d',date_create_from_format('Y-m-d H:i:s', $d1)->format('Y-m-d')),date_create_from_format('Y-m-d',date_create_from_format('Y-m-d H:i:s', $d2)->format('Y-m-d')));
        return $datediff->days;
    }

    public function displayUserLogs(){
        $user_id = Auth::id();
        $pastLogs = UserCopyLog::where("user_id",$user_id)->whereNotNull("date_returned")->join('copies','user_copy_logs.copy_id','=','copies.id')->join('books','copies.book_id','=','books.id')->orderBy("user_copy_logs.id","desc");
        $onLoan = UserCopyLog::where("user_id",$user_id)->whereNull("date_returned")->join('copies','user_copy_logs.copy_id','=','copies.id')->join('books','copies.book_id','=','books.id')->get();
        for($i = 0;$i<sizeof($onLoan);$i++){
            $onLoan[$i]->duedate =  date("Y-m-d", strtotime($onLoan[$i]->date_borrowed ." + 14 days"));
        }
        return view("user.userlogs",[
            "onLoan"=> $onLoan,
            "logs"=>$pastLogs->paginate("10"),
        ]);
    }

    public function displayFines(){
        $user_id = Auth::id();
        $unpaidFines = UserCopyLog::where("user_id",$user_id)->where("fines_paid","0")->join('copies','user_copy_logs.copy_id','=','copies.id')->join('books','copies.book_id','=','books.id')->get();
        $finesTotal = 0;
        foreach($unpaidFines as $fine){
            $daysdiff = $this->DateStrDaysDiff($fine->date_borrowed,$fine->date_returned)-14;
            $finesTotal+=$daysdiff*0.1;
        }
        return view("user.displayfines",[
            "unpaidFines" => $unpaidFines
        ]);
    }

    public function payFines(){
        $user_id = Auth::id();
        $unpaidFines = UserCopyLog::where("user_id",$user_id)->where("fines_paid","0")->get();

        foreach($unpaidFines as $fine){
            $fine->fines_paid=1;
            $fine->save();
        }
        return redirect("/user/fines?success=Successfully paid fines.");
    }
}
