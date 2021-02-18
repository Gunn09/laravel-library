@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="jumbotron showJumbotron">
            
            <h3> <strong>{{$books->title}}</strong> </h3>
            <img src="/images/{{ $books->thumbnail }}" class="float-left mr-3 rounded" style="height: 240px;"/>
            <label>Title - {{$books->title}} </label><br>
            <label>Author - {{$books->author}} </label><br>
            <p>Detail - <br> {{ Str::limit($books->detail, 200) }}
                @if(Str::length($books->detail) > 200)
                    <span id="dots"></span>
                    <span id="more" style="display: none;">{{ Str::substr($books->detail, 200) }}</span>
                    <button onclick="myFunction()" id="myBtn" class="btn btn-link">Read more</button>
                @endif
            </p>
            
            @if (Auth::check()) 
            <a href="/images/{{$books->file}}" class="btn btn-info">Read</a>
            <a href="/images/{{$books->file}}" class="btn btn-info" download>Download</a>
            @else 
            <a href=" {{ route('home') }} " class="btn btn-info">Read</a>
            <a href="{{ route('home') }}" class="btn btn-info">Download</a>
            @endif 
        </div>
            @foreach ($books->category as $cat)
                {{-- <a href="{{route('books.category', $cat->id)}}" class="btn btn-sm btn-outline-primary"> {{$cat->name}}</a> - --}}
                <a href="/books?cat={{ $cat->id}}" class="btn btn-sm btn-outline-primary"> {{$cat->name}}</a>
            @endforeach
    </div>
    <script>
        function myFunction() {
            var dots = document.getElementById("dots");
            var moreText = document.getElementById("more");
            var myText = document.getElementById("myBtn");

            if (dots.style.display === "none") {
                dots.style.display = "inline";
                myText.innerHTML = "Read more";
                moreText.style.display = "none";
            } else {
                dots.style.display = "none";
                myText.innerHTML = "Read less";
                moreText.style.display = "inline";
            }  
        }
    </script>
@endsection