@extends('layouts.user_header')
@section('title', 'Add New Post')
@section('content')
    <style>
        .thumb{
            margin: 10px 5px 0 0;
            width: 300px;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3" style="margin-top:50px">
                <h4>Add New Post</h4>
                <hr>

                @if (Session::get('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
                @endif

                @if (Session::get('fail'))
                <div class="alert alert-danger">
                    {{ Session::get('fail') }}
                </div>
                @endif
                <form action="store" method="POST" enctype="multipart/form-data">

                    @csrf
                    <div class="form-group">
                        <label for="content">Post Content</label>
                        <input type="text" class="form-control" name="content" value="{{ old('content') }}">
                        <span style="color: red">@error('content'){{ $message }} @enderror</span>
                    </div>

                    <div class="form-group">
                        <label for="image">Post Image</label>
                        <input type="file" onchange="loadPreview(this)" name="image[]" multiple>
                        <span style="color: red">@error('image'){{ $message }} @enderror</span>
                        <div id="thumb-output"></div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">SAVE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function loadPreview(input){
            var data = $(input)[0].files; //this file data
            $.each(data, function(index, file){
                if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){
                    var fRead = new FileReader();
                    fRead.onload = (function(file){
                        return function(e) {
                            var img = $('<img/>').addClass('thumb').attr('src', e.target.result); //create image thumb element
                            $('#thumb-output').append(img);
                        };
                    })(file);
                    fRead.readAsDataURL(file);
                }
            });
        }
     </script>
@endsection
