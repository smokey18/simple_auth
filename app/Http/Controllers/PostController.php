<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{
    function index()
    {
        $data = array(
            'list' => Post::all()
        );
        return view('post.list', $data);
    }

    function create()
    {
        return view('post.create');
    }

    function store(Request $request)
    {
        $request->validate([
            'content' => 'required'
        ]);

        $query = Post::insert([
            'content' => $request->input('content'),
            'image' => $request->input('image')
        ]);

        if ($query) {
            return back()->with('success', 'Post have been successfully inserted');
        } else {
            return back()->with('fail', 'Something went wrong');
        }
    }

    function edit($id)
    {

        $data = array(
            'list' => Post::where('id', $id)->first()
        );

        return view('post.edit', $data);
    }

    function update(Request $request)
    {
        $request->validate([
            'content' => 'required'
        ]);

        $Post = Post::find($request->input('cid'));
        $Post->content = $request->content;
        $Post->image = $request->image;

        $Post->save();

        return redirect('/list');
    }

    function destroy($id)
    {
        Post::where('id', $id)->delete();
        return redirect('/list');
    }
}