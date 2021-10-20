@extends('layouts.user_header')
@section('title', 'Posts List')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-3" style="margin-top:50px">
                <h4>Posts List</h4>

                <table class="table table-hover">
                    <thead>
                        <th>Sr.</th>
                        <th>Posts Added by</th>
                        <th>Posts Content</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        @foreach ($list as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>{!! $item->content !!}</td>
                            <td>
                                @foreach (explode('|', $item->image) as $newImage)
                                    <img width="75px" height="70px" src="/images/{{ $newImage }}">
                                @endforeach
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="delete/{{ $item->id }}" class="btn btn-danger btn-xs">Delete</a>
                                    <a href="edit/{{ $item->id }}" class="btn btn-primary btn-xs">Edit</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
