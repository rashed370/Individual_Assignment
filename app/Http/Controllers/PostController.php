<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function own()
    {
        $posts = Post::where('userid', auth()->user()->id)->get();
        return view('scout.posts.own', ['posts' => $posts]);
    }

    public function create()
    {
        return view('scout.posts.add');
    }

    public function create_post(Request $request)
    {
        $data = $request->validate([
            'place' => ['required', 'string', 'max:255', 'unique:posts,place'],
            'details' => ['required', 'string'],
            'country' => ['required', 'string', 'max:100'],
            'genre' => ['required', 'string', 'max:100'],
            'medium' => ['required', 'string', 'max:155'],
            'cost' => ['required', 'numeric']
        ]);

        $post = Post::create([
            'userid' => auth()->user()->id,
            'place' => $data['place'],
            'details' => $data['details'],
            'country' => $data['country'],
            'genre' => $data['genre'],
            'medium' => $data['medium'],
            'cost' => $data['cost'],
            'published' => 0
        ]);

        if($post->id)
        {
            $request->session()->flash('status', 'Post Request of Place '.$data['place'].' added successfully');
            return redirect()->route('posts_own');
        }

        $request->session()->flash('status_error', 'Post Request could not be added. Please try again');
        return redirect()->route('posts_create');
    }

    public function update($id, Request $request)
    {

    }

    public function update_post($id, Request $request)
    {

    }

    public function delete($id, Request $request)
    {

    }
}
