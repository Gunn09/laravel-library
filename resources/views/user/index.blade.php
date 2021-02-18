@extends('layouts')
@section('content')
    <div class="container">
        <div class="jumbotron">
            <h3>Your Upload Books</h3>
            <div class="cards">
                @foreach ($books as $book)
                    <div class="card card-inside">
                        <img src="/images/{{ $book->file }}" />
                        <div class="card-body">
                            <label> Title - {{ $book->title }}</label>
                            <label>Book Author - {{ $book->author }}</label>
                            <div class="row">
                            @if (Auth::check()) 
                            <a href="images/{{$book->file}}" class="btn btn-info mx-1 col">Read</a>
                            <a href="images/{{$book->file}}" class="btn btn-success col" download>Download</a>
                            @else 
                            <a href=" {{ route('home') }} " class="btn btn-info mx-1 col">Read</a>
                            <a href="{{ route('home') }}" class="btn btn-success col">Download</a>
                            @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection