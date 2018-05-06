<?php
/**
 * Created by PhpStorm.
 * User: Me
 * Date: 28/3/2018
 * Time: 5:11 PM
 */

/* This page will contain the search function and the results, if applicable.*/
?>

@extends('layouts.app')
@section('content')
    <div class="search-banner d-flex justify-content-center" style="height:40vh; margin-bottom: 1em">
        <div class="align-self-center">
            <h1 class="text-white">{{$bannerMessage}}</h1>
            <form class="navbar-form navbar-left" id="searchForm">
                <div class="input-group">
                    <select class="searchType" id="searchType">
                        <option value="title">Title</option>
                        @if(isset($searchType) and $searchType=="isbn")
                            <option value="isbn" selected>ISBN</option>
                        @else
                            <option value="isbn">ISBN</option>
                        @endif
                    </select>
                    <input type="text" class="searchField" id="searchField"
                        @if(isset($searchField)) value={{$searchField}} @endif
                    />
                    <button class="btn btn-default" type="submit" onclick="event.preventDefault();redirectSearchResult()"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </div>
    </div>
    <div class="container">
        @if(isset($books))
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
                    </table>
                </div>
            </div>
        @endforeach
            <div class="row">
                <div class="col">
                    {{$books->links("pagination::bootstrap-4")}}
                </div>
            </div>
        @endif
    </div>
    <script>
        function redirectSearchResult(){
            window.location.href = "{{route("search")}}" + "/" + $("#searchType").val() + "/" + $("#searchField").val();
        }
    </script>
@endsection