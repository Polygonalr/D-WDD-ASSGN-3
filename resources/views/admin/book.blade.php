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
    <h1 style="margin-top:1em" class="text-center">Add/Edit Book Information</h1>
    <div class="container">
        {!! Form::open(["method"=>"post","action"=>"AdminController@saveBook"]) !!}
        {!! Form::text("id",$book->id??"",["class"=>"form-control","hidden"=>""]) !!}
        <div class="form-group">
            {!! Form::label("title","Title") !!}
            {!! Form::text("title",$book->title??"",["class"=>"form-control","required"=>""]) !!}
        </div>
        <div class="form-group">
            {!! Form::label("isbn","ISBN") !!}
            {!! Form::text("isbn",$book->ISBN??"",["class"=>"form-control","required"=>""]) !!}
        </div>
        <div class="form-group">
            {!! Form::label("description","Description") !!}
            {!! Form::textarea("description",$book->description??"",["class"=>"form-control","required"=>""]) !!}
        </div>
        <div class="form-group">
            {!! Form::label("author_id","Author") !!}
            {!! Form::select('author_id', $authors,$book->author_id??"1",["class"=>"form-control","required"=>""]); !!}
        </div>
        {!! Form::submit("Submit",["class"=>"btn btn-success"]) !!}
        {!! Form::close() !!}
    </div>
@endsection
