@extends('layouts.app')
@section('content')
    <div class='container'>
        <h1>New Book</h1>
        <div class="jumbotron">
            <form class="form" method="POST" action="{{ Route('store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user_id }}">
                <div class="form-group">
                    <label for="title">Book Title</label>
                    <input type="text" id="title" name="title" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="author">Book Author</label>
                    <input type="text" id="author" name="author" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="file">File Upload</label>
                    <input type="file" name="file" id="file" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="detail">Book Detail</label>
                    <textarea name="detail" id="detail" cols="30" rows="5" class="form-control"></textarea>
                </div>
                    <fieldset>
                        <label>Choose Category - </label><br>
                            @foreach ($category as $cat)
                                <input id="{{$cat->id}}" name="category_id[]" type="checkbox" value="{{ $cat->id }}"/>
                                <label for="{{$cat->id}}" class="mr-2"> {{ $cat->name }}</label>
                            @endforeach
                            <button class="btn-submit btn btn-sm btn-info">Add New</button>
                    </fieldset>
                    <br>
                    <div>
                    <input type="submit" value="Upload" class="btn btn-success" />
                </div>
            </form>
        </div>
        <script>
            $(".btn-submit").click(function(e){
                e.preventDefault();
                var name = prompt("Enter new Category: ");
                let _token   = $('meta[name="csrf-token"]').attr('content');
                
                if (name == null || name == "") {
                    alert("Category Can't be empty");
                } else {
                    $.ajax({
                        type:'POST',
                        url:'{{ Route('books.category') }}',
                        data:{name:name, _token: _token},
                        success:function(data){
                            location.reload();
                        }
                    });
                }
            });
        </script>
    </div>
@endsection
