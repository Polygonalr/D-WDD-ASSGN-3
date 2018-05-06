<?php
/**
 * Created by PhpStorm.
 * User: Me
 * Date: 9/4/2018
 * Time: 2:00 PM
 */
?>

@extends('layouts.app')
@section('content')
    <div class="black-bar"><!--The black bar for the navbar!--></div>
    <div class="bar-filler"><!--filler for navbar--></div>
    <h1 style="margin-top:1em" class="text-center">New Book Copy</h1>
    @if(!isset($book))
        <h2 class="text-center">Please select a book from the admin control panel to add a copy for.</h2>
    @else
        <div class="container">
            <h4>Adding a new copy for <span class="text-muted">{{$book->title}}</span></h4>
            {!! Form::open(["method"=>"post","action"=>"AdminController@savecopy"]) !!}
            {!! Form::text("book_id",$book->id,["class"=>"form-control","hidden"=>""]) !!}
            <div class="form-group">
                {!! Form::label("date_purchased","Date Purchased") !!}
                {!! Form::date('date_purchased', \Carbon\Carbon::now(), ["class"=>"form-control","required"=>""]) !!}
            </div>
            {!! Form::submit("Submit",["class"=>"btn btn-success"]) !!}
            {!! Form::close() !!}
        </div>
    @endif
@endsection
