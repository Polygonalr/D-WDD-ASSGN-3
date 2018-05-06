@extends('layouts.app')
@section('content')
    <div class="black-bar"><!--The black bar for the navbar!--></div>
    <div class="bar-filler"><!--filler for navbar--></div>
    <div class="jumbotron author-banner"><div class="container"><h1>Author Info</h1></div></div>
    <div class="container">
        <div class="row">
            <div class="col">
                <table class="book-metadata">
                    <tr>
                        <td align="right" style="vertical-align: top;">Name:</td><td>{{$author->name}}</td>
                    </tr>
                    <tr>
                        <td align="right" style="vertical-align: top;">Biography:</td><td>{{$author->biography}}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row" style="border:1px solid #322322;margin-top:1em"></div>
        <div class="row" style="margin-top:1em">
            <div class="col">
                <h2>Books Published:</h2>
                <ul class="list-unstyled">
                @foreach($books as $book)
                    <li>
                        <table class="book-metadata" style="margin-bottom:1em; background-color:#F7F7F7;border:1px solid #BEBEBE">
                            <tr>
                                <td align="right">Title:</td><td><a href="{{route('bookinfo',$book->id)}}">{{$book->title}}</a></td>
                            </tr>
                            <tr>
                                <td align="right">ISBN:</td><td>{{$book->ISBN}}</td>
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
                    </li>
                @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection