<?php
/**
 * Created by PhpStorm.
 * User: Me
 * Date: 7/4/2018
 * Time: 8:43 PM
 */

/* Generic Error page for people who tries to do stuff for giggles */
?>

@extends('layouts.app')
@section('content')
    <div class="black-bar"><!--The black bar for the navbar!--></div>
    <div class="bar-filler"><!--filler for navbar--></div>
    <div class="error-banner d-flex justify-content-center">
        <div style="margin-top:20vh" class="text-center">
            <h1>Oops, we ran into an error.</h1>
            <h5>Error message: {{$message}}</h5>
        </div>
    </div>
@endsection
