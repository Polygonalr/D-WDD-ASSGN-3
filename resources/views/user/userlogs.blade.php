<?php
/**
 * Created by PhpStorm.
 * User: Me
 * Date: 28/3/2018
 * Time: 5:14 PM
 */

/* This page will display a user's borrowing history, together with his currently borrowed books.
 * On this page, a user is able to return books as well.
*/
?>

@extends('layouts.app')
@section('content')
    <div class="user-logs-banner"><div class="container d-flex" style="height:100%"><h1 class="align-self-center text-white">Borrowing History</h1></div></div>
    @if(app('request')->input('error')!=NULL)
        <div class="alert alert-danger"><div class="container">{{app('request')->input('error')}}</div></div>
    @elseif(app('request')->input('success')!=NULL)
        <div class="alert alert-success"><div class="container">{{app('request')->input('success')}}</div></div>
    @endif
    <div class="container">
        <h2 style="margin-top: 0.5em">Currently on Loan</h2>
        <table class="table table-bordered table-condensed table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Title</th>
                    <th>Date Borrowed</th>
                    <th>Due Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @if(sizeof($onLoan)==0)
                <td colspan="4">You currently have no books on loan.</td>
            @else
            @foreach ($onLoan as $copy)
                <tr>
                    <td>{{$copy->title}}</td>
                    <td>{{date("Y-m-d", strtotime($copy->date_borrowed))}}</td>
                    <td>{{$copy->duedate}}</td>
                    <td>
                    {!! Form::open(['method'=>'post','action'=>"HomeController@returnbook"])!!}
                    {!! Form::text("copy_id",$copy->copy_id, ["hidden"=>"yes"]) !!}
                    {!! Form::text("prevURL",Request::url(), ["hidden"=>"yes"]) !!}
                    {!! Form::submit("Return",["class"=>"btn btn-primary text-white"]) !!}
                    {!! Form::close() !!}
                    <!--a href="{{route("returnbook",$copy->id)}}" class="btn btn-primary text-white">Return</a-->
                    </td>
                </tr>
            @endforeach
            @endif
            </tbody>
        </table>
        <h2 id="history">History</h2>
        <table class="table table-bordered table-condensed table-hover" >
            <thead class="thead-dark">
                <tr>
                    <th>Title</th>
                    <th>Date Borrowed</th>
                    <th>Date Returned</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logs as $log)
                    <tr>
                        <td>{{$log->title}}</td>
                        <td>{{date("Y-m-d", strtotime($log->date_borrowed))}}</td>
                        <td>{{date("Y-m-d", strtotime($log->date_returned))}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div style="padding-bottom:0.5em">
            {{ $logs->links("pagination::bootstrap-4") }}
        </div>
    </div>
@endsection
