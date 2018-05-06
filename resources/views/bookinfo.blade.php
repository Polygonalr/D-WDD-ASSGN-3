<?php
/**
 * Created by PhpStorm.
 * User: Me
 * Date: 28/3/2018
 * Time: 5:12 PM
 */

/* This page will contain information on a book that the user has selected, together with all the copies
 * of the book that is available. Each copy will also show whether it is already borrowed. A user can
 * then choose to borrow a book online if the copy of book that he had selected to borrow is available.
 * Reminder that user cannot borrow a book if he has overdue book(s) or already borrowed 4 books.
*/

?>
@extends('layouts.app')
@section('content')
    <div class="black-bar"><!--The black bar for the navbar!--></div>
    <div class="bar-filler"><!--filler for navbar--></div>
    @if(app('request')->input('error')!=NULL)
        <div class="alert alert-danger"><div class="container">{{app('request')->input('error')}}</div></div>
    @elseif(app('request')->input('success')!=NULL)
        <div class="alert alert-success"><div class="container">{{app('request')->input('success')}}</div></div>
    @endif
    <div class="jumbotron book-banner"><div class="container"><h1>Book Info</h1></div></div>
    <div class="container">
        <div class="row">
            <div class="col">
                <table class="book-metadata">
                    <tr>
                        <td align="right">Title:</td><td><a href="{{route('bookinfo',$book->id)}}">{{$book->title}}</a></td>
                    </tr>
                    <tr>
                        <td align="right">Author:</td><td><a href="{{route('authorinfo',$book->author->id)}}">{{$book->author->name}}</a></td>
                    </tr>
                    <tr>
                        <td align="right" style="vertical-align: top;">Description:</td><td>{{$book->description}}</td>
                    </tr>
                    <tr>
                        <td align="right" style="vertical-align: top">Categories:</td>
                        <td><ul class="list-unstyled">
                            @foreach($book->categories as $category)
                                <a href="{{route("category",lcfirst($category->description))}}"><li class="text-muted">{{$category->description}}</li></a>
                            @endforeach
                        </ul></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row" style="border:1px solid #322322;margin-top:1em"></div>
        <div class="row">
            <div class="col">
                <table class="table table-bordered table-condensed table-hover" style="margin-top:2em">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Date Purchased</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $copyNo = 1 ?>
                        @foreach ($copies as $copy)
                            <tr>
                                <td><?php echo $copyNo ?></td>
                                <td>{{date("Y-m-d", strtotime($copy->date_purchased))}}</td>
                                @if($copy->borrowed==false)
                                    <td>Available</td>
                                    <td>
                                        {!! Form::open(['method'=>'post','action'=>"HomeController@borrowBook"])!!}
                                        {!! Form::text("copy_id",$copy->id, ["hidden"=>"yes"]) !!}
                                        {!! Form::submit("Borrow",["class"=>"btn btn-success text-white"]) !!}
                                        {!! Form::close() !!}
                                    </td>
                                @elseif($copy->mine==true)
                                    <td>You borrowed this!<br/>Due date: {{$copy->duedate}}</td>
                                    <td>
                                        {!! Form::open(['method'=>'post','action'=>"HomeController@returnbook"])!!}
                                        {!! Form::text("copy_id",$copy->id, ["hidden"=>"yes"]) !!}
                                        {!! Form::text("prevURL",Request::url(), ["hidden"=>"yes"]) !!}
                                        {!! Form::submit("Return",["class"=>"btn btn-primary text-white"]) !!}
                                        {!! Form::close() !!}
                                        <!--a href="{{route("returnbook",$copy->id)}}" class="btn btn-primary text-white">Return</a-->
                                    </td>
                                @else
                                    <td>On Loan</td>
                                    <td></td>
                                @endif
                            </tr>
                            <?php $copyNo++ ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
