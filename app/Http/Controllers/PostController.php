<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostDelete;
use App\PostUpdate;
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
        return view('admin.posts.pending', ['posts' => $posts]);
    }

    public function modification()
    {
        $posts = PostUpdate::get();
        return view('admin.posts.modification', ['posts' => $posts]);
    }

    public function delete_list()
    {
        $posts = PostDelete::get();
        return view('admin.posts.delete', ['posts' => $posts]);
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
        $post = Post::find($id);

        if($post!=null) {

            if(auth()->user()->role=='admin' || $post->userid==auth()->user()->id)
            {
                return view('admin.posts.edit', ['post' => $post]);
            }

            return redirect()->route('home');
        }

        $request->session()->flash('status_error', 'Post not found');
        return redirect()->route('home');
    }

    public function update_post($id, Request $request)
    {
        $post = Post::find($id);

        if($post!=null) {

            if(auth()->user()->role=='admin' || $post->userid==auth()->user()->id)
            {
                $data = $request->validate([
                    'place' => ['required', 'string', 'max:255', 'unique:posts,place,'.$post->id],
                    'details' => ['required', 'string'],
                    'country' => ['required', 'string', 'max:100'],
                    'genre' => ['required', 'string', 'max:100'],
                    'medium' => ['required', 'string', 'max:155'],
                    'cost' => ['required', 'numeric']
                ]);

                if(auth()->user()->role=='admin') {
                    $post->place = $data['place'];
                    $post->details = $data['details'];
                    $post->country = $data['country'];
                    $post->genre = $data['genre'];
                    $post->medium = $data['medium'];
                    $post->cost = $data['cost'];

                    if($post->save()) {
                        $request->session()->flash('status', 'Information updated successfully');
                        return redirect()->route('home');
                    }

                    $request->session()->flash('status_error', 'Please make any changes to update');
                    return redirect()->route('posts_update', ['id' => $id]);
                } else {
                    $postUpdate = PostUpdate::create([
                        'postid' => $post->id,
                        'place' => $data['place'],
                        'details' => $data['details'],
                        'country' => $data['country'],
                        'genre' => $data['genre'],
                        'medium' => $data['medium'],
                        'cost' => $data['cost']
                    ]);

                    if($postUpdate->id) {
                        $request->session()->flash('status', 'Information update request added successfully');
                        return redirect()->route('posts_own');
                    }

                    $request->session()->flash('status_error', 'Please make any changes to update');
                    return redirect()->route('posts_update', ['id' => $id]);
                }
            }

            return redirect()->route('home');
        }

        $request->session()->flash('status_error', 'Post not found');
        return redirect()->route('home');
    }

    public function delete($id, Request $request)
    {
        $post = Post::find($id);

        if($post!=null) {

            $post->removes()->delete();
            $post->delete();

            $request->session()->flash('status', 'Post place '.$post->place.' removed successfully');
            return redirect()->route('home');
        }

        $request->session()->flash('status_error', 'Post not found');
        return redirect()->route('home');
    }

    public function delete_request($id, Request $request) {
        $post = Post::find($id);

        if($post!=null) {

            if($post->userid==auth()->user()->id)
            {
                $postDelete = PostDelete::create(['postid' => $post->id]);

                if($postDelete->id) {
                    $request->session()->flash('status', 'Post place '.$post->place.' successfully added to delete request');
                }

            }

            return redirect()->route('home');
        }

        $request->session()->flash('status_error', 'Post not found');
        return redirect()->route('home');
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

    public function modification_details($id, Request $request)
    {
        $post = PostUpdate::find($id);

        if($post!=null) {

            return view('admin.posts.modification_edit', ['post' => $post]);
        }

        $request->session()->flash('status_error', 'Post not found');
        return redirect()->route('posts_modification');
    }

    public function modification_details_post($id, Request $request)
    {
        $postUpdate = PostUpdate::find($id);

        if($postUpdate!=null) {

            $data = $request->validate([
                'place' => ['required', 'string', 'max:255', 'unique:posts,place,'.$postUpdate->post->id],
                'details' => ['required', 'string'],
                'country' => ['required', 'string', 'max:100'],
                'genre' => ['required', 'string', 'max:100'],
                'medium' => ['required', 'string', 'max:155'],
                'cost' => ['required', 'numeric']
            ]);

            $postUpdate->post->place = $data['place'];
            $postUpdate->post->details = $data['details'];
            $postUpdate->post->country = $data['country'];
            $postUpdate->post->genre = $data['genre'];
            $postUpdate->post->medium = $data['medium'];
            $postUpdate->post->cost = $data['cost'];

            if($postUpdate->post->save()) {
                $postUpdate->delete();
                $request->session()->flash('status', 'Information updated successfully');
                return redirect()->route('posts_modification');
            }

            $request->session()->flash('status_error', 'Please make any changes to update');
            return redirect()->route('posts_modification_detail', ['id' => $id]);

        }

        $request->session()->flash('status_error', 'Post not found');
        return redirect()->route('posts_modification');
    }

    public function modification_delete($id, Request $request)
    {
        $post = PostUpdate::find($id);

        if($post!=null) {
            $post->delete();
            $request->session()->flash('status', 'Post of place '.$post->post->place.' changes request removed successfully');
            return redirect()->route('posts_modification');
        }

        $request->session()->flash('status_error', 'Post not found');
        return redirect()->route('posts_modification');
    }
}
