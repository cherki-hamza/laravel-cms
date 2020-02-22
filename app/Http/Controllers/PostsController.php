<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('checkCategory')->only('create');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts' , Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories' , Category::all())->with('tags' , Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
         //dd($request->all());
       //dd($request->image->store('images' , 'public'));
        $post = Post::create([
           'title'  => $request->input('title'),
           'description'  => $request->input('description'),
           'content'  => $request->input('content'),
           'image'  => $request->image->store('images' , 'public'),
           'category_id' => $request->input('categoryID')
        ]);
        if ($request->tags){
            $post->tags()->attach($request->tags);
        }

        session()->flash('success' , 'the post saved successfully');
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('posts.create')->with('post' , $post)->With('categories' , $categories)->with('tags' , Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->only(['title','description','content','category_id']);
        if ($request->hasFile('image')){
            // get the image request from input form
            $image = $request->image->store('images' , 'public');
            // delete the previous image from the disk storage
            Storage::disk('public')->delete($post->image);
            // add the image to the data
            $data['image'] = $image;
        }

        // check if request has tag and sync the request by check if the id in array
        if ($request->tags){
            $post->tags()->sync($request->tags);
        }

        $post->update($data);

        session()->flash('success' , 'the Post Updated successfully');
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id' , $id)->first();
        if ($post->trashed()){
            //Storage::delete($post->image);
            Storage::disk('public')->delete($post->image);
            $post->forceDelete();
        }else{
            $post->delete();
        }
        session()->flash('success' , 'the post trashed successfully');
        return redirect(route('posts.index'));
    }

    // method for trashed posts
    public function trashed(){
        $trashed = Post::onlyTrashed()->get();
        return view('posts.index')->withPosts($trashed);
    }

    // method for restore posts
    public function restore($id){
        Post::withTrashed()->where('id' , $id)->restore();
        session()->flash('success' , 'the post restore successfully');
        return redirect(route('posts.index'));
    }


}
