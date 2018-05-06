<?php
/**
 * Created by PhpStorm.
 * User: Me
 * Date: 28/3/2018
 * Time: 5:17 PM
 */

/* This page will display outstanding fines that the user has yet to pay,
 * followed by an option to do so.
 */
?>

@extends('layouts.app')
@section('content')
<div class="user-logs-banner"><div class="container d-flex" style="height:100%"><h1 class="align-self-center text-white">Outstanding Fines</h1></div></div>
@if(app('request')->input('error')!=NULL)
    <div class="alert alert-danger"><div class="container">{{app('request')->input('error')}}</div></div>
@elseif(app('request')->input('success')!=NULL)
    <div class="alert alert-success"><div class="container">{{app('request')->input('success')}}</div></div>
@endif
<div class="container" style="margin-top:0.5em">
    <table class="table table-bordered table-condensed table-hover">
        <thead class="thead-dark">
        <tr>
            <th>Title</th>
            <th>Date Borrowed</th>
            <th>Days Overdue</th>
            <th>Outstanding fines</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $totalFinesDue = 0;
        ?>
            @foreach($unpaidFines as $fine)
                <?php
                    $daysOverDue = date_diff(date_create_from_format('Y-m-d',date_create_from_format('Y-m-d H:i:s', $fine->date_borrowed)->format('Y-m-d')),date_create_from_format('Y-m-d',date_create_from_format('Y-m-d H:i:s', $fine->date_returned)->format('Y-m-d')))->days;
                    $totalFinesDue += $daysOverDue*0.1;
                ?>
                <tr>
                    <td>{{$fine->title}}</td>
                    <td>{{date("Y-m-d", strtotime($fine->date_borrowed))}}</td>
                    <td>{{$daysOverDue-14}} days</td>
                    <td>${{number_format((float)$daysOverDue*0.1,2,'.','')}}</td>
                </tr>
            @endforeach
        <td colspan="3">Total fines due:</td><td>${{number_format((float)$totalFinesDue,2,'.','')}}</td>
        </tbody>
    </table>
    <div class="row">
        <div class="col">
            {!! Form::open(["action"=>"UserController@payFines","method"=>"post"]) !!}
            {!! Form::submit("Automatically pay by Paypal",["class"=>"btn btn-primary"]) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection