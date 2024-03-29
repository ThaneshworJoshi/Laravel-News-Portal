<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class ListingPageController extends Controller
{
    public function index()
    {
        return view('front.listing');
    }

    public function listing($id)
    {
        $posts = Post::with(['comments', 'creator', 'category'])->where('status', 1)->where('category_id', $id)->orWhere('created_by', $id)->orderBy('id', 'DESC')->paginate(3);
        return view('front.listing', compact('posts'));
    }
}
