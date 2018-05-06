@extends('layouts.app')
@section('content')
    <div class="black-bar"><!--The black bar for the navbar!--></div>
    <div class="bar-filler"><!--filler for navbar--></div>
    <div class="jumbotron category-banner text-white"><div class="container"><h1>Displaying Books under <i style="color:#CCCCCC">{{$category->description}}</i> category.</h1></div></div>
    <div class="container">
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
    </div>
@endsection