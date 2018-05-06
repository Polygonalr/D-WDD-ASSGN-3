<?php
/**
 * Created by PhpStorm.
 * User: Me
 * Date: 9/4/2018
 * Time: 2:01 PM
 */
?>

@extends('layouts.app')
@section('content')
    <div class="black-bar"><!--The black bar for the navbar!--></div>
    <div class="bar-filler"><!--filler for navbar--></div>
    <h1 style="margin-top:1em" class="text-center">Add/Edit Author Information</h1>
    <div class="container">
        {!! Form::open(["method"=>"post","action"=>"AdminController@saveauthor"]) !!}
        {!! Form::text("id",$author->id??"",["class"=>"form-control","hidden"=>""]) !!}
        <div class="form-group">
            {!! Form::label("name","Name") !!}
            {!! Form::text("name",$author->name??"",["class"=>"form-control","required"=>""]) !!}
        </div>
        <div class="form-group">
            {!! Form::label("biography","Biography") !!}
            {!! Form::text("biography",$author->biography??"",["class"=>"form-control","required"=>""]) !!}
        </div>
        {!! Form::submit("Submit",["class"=>"btn btn-success"]) !!}
        {!! Form::close() !!}
    </div>
@endsection
