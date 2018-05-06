@extends('layouts.app')
@section('content')
    <div class="black-bar"><!--The black bar for the navbar!--></div>
    <div class="bar-filler"><!--filler for navbar--></div>
    <div class="jumbotron display-categories-banner text-white"><div class="container"><h1>Categories</h1></div></div>
    <div class="container">
        <div class="row">
            @foreach($categories as $category)
            <div class="col-md-4 col-sm-6">
                <a href="{{route("category",lcfirst($category->description))}}">
                    <div class="category-box d-flex justify-content-center">
                        <div class="align-self-center">{{$category->description}}</div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
@endsection