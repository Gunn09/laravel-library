@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="container-md border rounded p-3">
            <h6>Browse by Subject</h6>
            <div class="form-group">
                @foreach ($categories as $category)
                    {{-- <a href="{{route('books.category', $category->id)}}" class="btn btn-sm btn-outline-primary"> {{$category->name}}</a> --}}
                    <a href="/books?cat={{$category->id}}" class="btn btn-sm btn-outline-primary"> {{$category->name}}</a>
                @endforeach
            </div>
            {{-- <a href="{{ route('books.export')}}">Export Data</a> --}}
            <div class="owl-carousel owl-theme" id="owl-demo">
                @foreach ($books as $book)
                    <div class="cards">
                        <div class="item">
                            <div class="card card-inside">
                                <a href=" {{ route('books.show', $book->id)}}" class="thumbnail">
                                    <img src="/images/{{ $book->thumbnail }}" class="image" style="height: 240px" /></a>
                                <div class="card-body">
                                    <div class="row">
                                        <a href="images/{{$book->file}}" class="btn btn-info mx-1 col">Read</a>
                                        <a href="images/{{$book->file}}" class="btn btn-info col" download>Download</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        {{-- <span class="d-flex justify-content-center">{{ $books->links() }}</span> --}}
    </div>
    </div>
    <script>
        jQuery(document).ready(function($){
          $('.owl-carousel').owlCarousel({
            loop:true,
            nav:true,
            margin:4,
            dots: false,
            autoplay: true,
            autoplaySpeed: 1000,
            responsive:{
              0:{
                items:1
              },
              600:{
                items:3
              },
              1000:{
                items:5
              }
            }
          })
        })
    </script>
     
@endsection
