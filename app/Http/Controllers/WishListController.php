<?php

namespace App\Http\Controllers;

use App\Post;
use App\WishList;
use Illuminate\Http\Request;

class WishListController extends Controller
{
    public function index()
    {
        $posts = WishList::where('userid', auth()->user()->id);
        return view('user.checklist.index', ['posts' => $posts->get()]);
    }

    public function add($id, Request $request)
    {
        $post = Post::find($id);

        if($post!=null) {

            $wish = WishList::create([
                'userid' => auth()->user()->id,
                'postid' => $id
            ]);

            if($wish->id) {
                $request->session()->flash('status', 'Post of Place '.$post->place.' added to your Wish List');
                return redirect()->route('posts');
            }
        }

        $request->session()->flash('status_error', 'Post not found');
        return redirect()->route('posts');
    }

    public function remove($id, Request $request)
    {
        $wish = WishList::find($id);

        if($wish!=null) {

            $wish->delete();
            $request->session()->flash('status', 'Post of Place '.$wish->post->place.' removed from your Wish List');
            return redirect()->route('wishlist');

        }

        $request->session()->flash('status_error', 'Item not found');
        return redirect()->route('wishlist');
    }
}
