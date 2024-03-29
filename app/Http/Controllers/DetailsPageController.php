<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class DetailsPageController extends Controller
{
    public function index($slug)
    {
        $post = Post::with(['creator', 'category', 'comments'])->where('status', 1)->where('slug', $slug)->first();
        // dd($post);
        $post->view_count = $post->view_count + 1;

        $related_news = Post::with(['creator', 'category', 'comments'])->where('status', 1)->where('id', '!=', $post->id)
            ->where('category_id', $post->category_id)->orderBy('id', 'DESC')->limit(4)->get();
        $post->save();

        $categories = Category::where('status', 1)->get();
        // dd($categories);
        return view('front.details', compact('post', 'related_news', 'categories'));
    }

    public function comment(Request $request)
    {

        $request->validate([
            'name' => 'bail|required',
            'post_id' => 'required',
            'comment' => 'required',
            'slug' => 'required'
        ]);

        $comment = new Comment();
        $comment->name = $request->name;
        $comment->comment = $request->comment;
        $comment->post_id = $request->post_id;
        $comment->status = 0;

        $comment->save();



        return redirect()->route('details', ['slug' => $request->slug])->with('success', 'Comment Send Successfully');
    }
}
