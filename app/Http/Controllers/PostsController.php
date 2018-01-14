<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use DB;

class PostsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts = Post::all();
        //return Post::where('title', 'Post Four')->get();
        //$posts = DB::select('SELECT * FROM posts');
        //$posts = Post::orderBy('created_at', 'desc')->take(1)->get();
        $posts = Post::orderBy('created_at', 'desc')->paginate(5); //Separate inserts one per page
        //$posts = Post::orderBy('created_at', 'desc')->get();
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'music' => 'required|mimes:mpga,mp4'
        ]);
        // Handle File Upload
        // Get Filename With The Extension
        $fileNameWithExt = $request->file('music')->getClientOriginalName();
        
        // Get Just Filename
        $filename = pathInfo($fileNameWithExt, PATHINFO_FILENAME); // Basic PHP
        // Get Just Extension
        $extension = $request->file('music')->getClientOriginalExtension(); //Laravel option
        // Create Filename To Store
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        //Upload Image
        
        $path = $request->file('music')->storeAs('public/all_files', $fileNameToStore);
        /* php artisan storage:link //ieliek pointeri uz public mapi un storeAs veido tad tur
        mapi stprage, nevis uz storage/app/public, kura ir pieejama no brauzera. */

        // Create Post
        $post = new Post();
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id; //Ieliek iekšā ielogotā lietotāja id
        $post->cover_image = $fileNameToStore;
        $post->save();

        return redirect('/dashboard')->with('success', 'Music Uploaded');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        // Check for correct user
        if(auth()->user()->id !== $post->user_id) {
            return redirect('/music')->with('error', 'Unauthorized Page');
        }

        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'music' => 'image|nullable|max:1999'
        ]);

        // Handle File Upload
        if($request->hasFile('music')) {
            // Get Filename With The Extension
            $fileNameWithExt = $request->file('music')->getClientOriginalName();

            // Get Just Filename
            $filename = pathInfo($fileNameWithExt, PATHINFO_FILENAME); // Basic PHP
            // Get Just Extension
            $extension = $request->file('music')->getClientOriginalExtension(); //Laravel option
            // Create Filename To Store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('music')->storeAs('public/all_files', $fileNameToStore);
            /* php artisan storage:link //ieliek pointeri uz public mapi un storeAs veido tad tur
            mapi stprage, nevis uz storage/app/public, kura ir pieejama no brauzera. */
        }

        // Update Post
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('music')) {
            $post->cover_image = $fileNameToStore;
        }
        $post->save();

        return redirect('/music')->with('success', 'Music Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        // Check for correct user
        if(auth()->user()->id !== $post->user_id) {
            return redirect('/music')->with('error', 'Unauthorized Page');
        }

        //Delete Image
        Storage::delete('public/all_files/'.$post->cover_image);


        $post->delete();
        return redirect('/dashboard')->with('success', 'Music Removed');
    }
}
