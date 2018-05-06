@extends('layouts.app')

@section('content')
<div class="cover-banner d-flex align-items-center justify-content-center" style="height:50vh">
    <div class="align-self-center">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="align-self-center text-white">Online DIY borrowing service, for all your reading needs.</h1>
                </div>
                <div class="col">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <a class="btn btn-block text-white" href="{{route("categories")}}" style="background:#8923c4">Browse by Category</a>
                            </div>
                            <div class="col">
                                <a class="btn btn-block text-white" href="{{route("search")}}" style="background:#c68b00">Search Books</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="container h-50">
    <div class="row">
        <div class="col not-sure-text" style="margin-top:20px; margin-bottom:20px">
            <h2>Not sure where to start? Check out our latest added books below:</h2>
        </div>
    </div>
    <div class="row">
        @foreach($newBooks as $book)
            <div class="col">
                <div class="featured-box text-center d-flex align-items-center justify-content-center">
                    <div class="under">
                        <h4>{{$book->title}}</h4>
                        <h5>By {{$book->author->name}}</h5>
                        <ul style="list-style-type: none;padding: 0;">
                            @foreach($book->categories as $category)
                                <li class="text-muted">{{$category->description}}</li>
                            @endforeach
                        </ul>
                    </div>
                    <a href="{{route("bookinfo",$book->id)}}">
                        <div class="over">
                            {{$book->description}}
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
<div class="h-100">

</div>
<script>
    $(".featured-box .over").mouseenter(function(){
       $(this).css("opacity","1");
    });
    $(".featured-box .over").mouseleave(function(){
        $(this).css("opacity","0");
    });
</script>
@endsection
