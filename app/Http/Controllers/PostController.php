<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {

    }

    public function own()
    {
        $posts = Post::where('userid', auth()->user()->id)->get();
        return view('scout.posts.own', ['posts' => $posts]);
    }

    public function pending()
    {
        $posts = Post::where('published', 0)->get();
        return view('scout.posts.pending', ['posts' => $posts]);
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

    public function approve($id, Request $request)
    {
        $post = Post::find($id);

        if($post!=null) {

            $post->published = 1;

            if($post->save()) {
                $request->session()->flash('status', 'Post Request of Place '.$post->place.' approved successfully');
                return redirect()->route('posts_pending');
            }

            $request->session()->flash('status_error', 'Something went wrong. Please try again later');
            return redirect()->route('posts_pending');
        }

        $request->session()->flash('status_error', 'Post not found');
        return redirect()->route('posts_pending');
    }
}
