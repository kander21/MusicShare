<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\User;
use App\Comment;
use DB;

class CommentsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

   /* public function create()
    {
        return view('comments.create');
    }*/

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);
        $data = $request->all();
        $comment = new Comment();
        $comment->info = $request->input('body');
        $comment->user_id = auth()->user()->id; //Ieliek iekšā ielogotā lietotāja id
        $comment->post_id = $data['music_id'];
        $comment->save();

        return redirect("/music/".$data['music_id']);
    }
}