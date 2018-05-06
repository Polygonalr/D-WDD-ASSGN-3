<?php
/**
 * Created by PhpStorm.
 * User: Me
 * Date: 10/4/2018
 * Time: 5:01 PM
 */
?>

@extends('layouts.app')
@section('content')
    <div class="black-bar"><!--The black bar for the navbar!--></div>
    <div class="bar-filler"><!--filler for navbar--></div>
    <h1 style="margin-top:1em" class="text-center">Add new category</h1>
    <div class="container">
        {!! Form::open(["method"=>"post","action"=>"AdminController@savecategory"]) !!}
        <div class="form-group">
            {!! Form::label("description","Description") !!}
            {!! Form::text("description","",["class"=>"form-control","required"=>""]) !!}
        </div>
        {!! Form::submit("Submit",["class"=>"btn btn-success"]) !!}
        {!! Form::close() !!}
    </div>
@endsection
