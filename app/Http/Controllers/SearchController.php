<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\Comment;
use App\User;
use DB;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $title = $request->input('title');
        return view('posts.index')->with('posts',Post::where('title', 'like' ,'%'.$title.'%')->paginate(5));
    }
}
