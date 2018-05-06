<?php
/**
 * Created by PhpStorm.
 * User: Me
 * Date: 10/4/2018
 * Time: 8:32 PM
 */
?>

@extends('layouts.app')
@section('content')
    <div class="black-bar"><!--The black bar for the navbar!--></div>
    <div class="bar-filler"><!--filler for navbar--></div>
    <h1 style="margin-top:1em" class="text-center">Assigning <span class="text-muted">{{$book->title}}</span> categories</h1>
    <div class="container">
        {!! Form::open(["method"=>"post","action"=>"AdminController@savebookcategory"]) !!}
        {!! Form::text("book_id",$book->id,["hidden"=>""]) !!}
        <div class="form-group">
            {!! Form::select("categories[]",$categories,$selectedcategories,["class"=>"form-control","required"=>"","multiple"=>"multiple"]) !!}
        </div>
        {!! Form::submit("Submit",["class"=>"btn btn-success"]) !!}
        {!! Form::close() !!}
    </div>
@endsection
