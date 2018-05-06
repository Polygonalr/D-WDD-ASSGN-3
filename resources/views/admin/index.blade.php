<?php
/**
 * Created by PhpStorm.
 * User: Me
 * Date: 9/4/2018
 * Time: 1:44 PM
 */
?>

@extends('layouts.app')
@section('content')
    <div class="black-bar"><!--The black bar for the navbar!--></div>
    <div class="bar-filler"><!--filler for navbar--></div>
    @if(app("request")->input('message')!="")
        <div class="alert alert-success"><div class="container">{{app("request")->input('message')}}</div></div>
    @endif
    <h1 style="margin-top:1em" class="text-center">Admin Control Panel</h1>
    <div class="container">
        <div class="row" style="margin-bottom:0.5em">
            <div class="col">
                <a href="{{route("admin.newbook")}}" class="btn btn-block btn-warning">Add new book</a>
            </div>
            <div class="col">
                <a href="{{route("admin.addcategory")}}" class="btn btn-block btn-info">Add new Category</a>
            </div>
            <div class="col">
                <a href="{{route("admin.addauthor")}}" class="btn btn-block btn-danger">Add new Author</a>
            </div>
        </div>
        @foreach($books as $book)
            <div class="row">
                <div class="col">
                    <table class="book-metadata" style="margin-bottom:1em; background-color:#F7F7F7;border:1px solid #BEBEBE">
                        <tr>
                            <td align="right">Title:</td><td><a href="{{route('bookinfo',$book->id)}}">{{$book->title}}</a></td>
                        </tr>
                        <tr>
                            <td align="right">ISBN:</td><td>{{$book->ISBN}}</td>
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
                        <tr>
                            <td align="right" style="vertical-align: top">Actions:</td>
                            <td>
                                <span>
                                    {!! Form::open(["action"=>"AdminController@bookcategory","method"=>"post","style"=>"display:inline"]) !!}
                                    {!! Form::text("book_id",$book->id,["hidden"=>""]) !!}
                                    {!! Form::submit("Assign Category",["class"=>"btn btn-primary"]) !!}
                                    {!! Form::close() !!}
                                    {!! Form::open(["action"=>"AdminController@editbook","method"=>"post","style"=>"display:inline"]) !!}
                                    {!! Form::text("book_id",$book->id,["hidden"=>""]) !!}
                                    {!! Form::submit("Edit Book Info",["class"=>"btn btn-success"]) !!}
                                    {!! Form::close() !!}
                                    {!! Form::open(["action"=>"AdminController@addcopy","method"=>"post","style"=>"display:inline"]) !!}
                                    {!! Form::text("book_id",$book->id,["hidden"=>""]) !!}
                                    {!! Form::submit("Add a copy",["class"=>"btn btn-default"]) !!}
                                    {!! Form::close() !!}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        @endforeach
    </div>
@endsection
