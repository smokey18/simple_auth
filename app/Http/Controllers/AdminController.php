<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    function index()
    {
        $data = array(
            'list' => Post::all()
        );
        return view('admin.list', $data);
    }

    function create()
    {
        return view('admin.create');
    }

    function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'image' => 'required'
        ]);

        $image = array();
        if ($file = $request->file('image')) {
            foreach ($file as $newFile) {
                $extension  = $newFile->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $newFile->move('images/', $filename);
                $image[] = $filename;
            }
            Post::create([
                'user_id' => Auth::user()->id,
                'content' => $request->content,
                'image' => implode('|', $image),
            ]);
        }

        if ($image) {
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

        return view('admin.edit', $data);
    }

    function update(Request $request)
    {
        $request->validate([
            'content' => 'required'
        ]);

        $Post = Post::find($request->input('cid'));
        $Post->content = $request->content;

        if ($request->hasFile('image')) {

            $path = 'images/' . $Post->image;
            if (File::exists($path)) {
                File::delete($path);
            }

            $file = $request->file('image');
            $extension  = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('images/', $filename);
            $Post->image = $filename;
        }

        $Post->save();

        return redirect('admin/list');
    }

    function destroy($id)
    {
        Post::where('id', $id)->delete();
        return redirect('admin/list');
    }
}