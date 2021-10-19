@extends('layouts.admin_header')
@section('title', 'Edit Post')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3" style="margin-top:50px">
                <h4>Edit Post</h4>
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
                <form action="{{ route('admin.update') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                <input type="hidden" name="cid" value="{{ $list->id }}">
                    <div class="form-group">
                        <label for="content">Post Content</label>
                        <input type="text" class="form-control" name="content" value="{{ $list->content }}">
                        <span style="color: red">@error('content'){{ $message }} @enderror</span>
                    </div>

                    <div class="form-group">
                        <label for="image">Post Image</label>
                        <input type="file" class="form-control" name="image">
                        <img src="{{ asset('images/' . $list->image) }}" width="75px" height="70px"/>
                        <span style="color: red">@error('image'){{ $message }} @enderror</span>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">UPDATE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
