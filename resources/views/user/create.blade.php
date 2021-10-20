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
                        <textarea name="content" class="form-control" id="text-area" value="{{ old('content') }}"></textarea>
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
@endsection
