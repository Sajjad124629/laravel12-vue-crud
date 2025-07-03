<?php

namespace App\Http\Controllers;

use App\Models\Post;

use App\Traits\MessageTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class PostController extends Controller
{
    use MessageTraits;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return Inertia::render('post/Post', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return Inertia::render('post/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'body' => 'required',
            ],
            [
                'title.required' => 'Title is required',
                'body.required' => 'Body is required',

            ],
        );
        $errors = $validator->errors();
        if ($errors->any()) {
            return $this->validationError($errors->first());
        }
        Post::create([
            'title' => $request->title,
            'body' => $request->body,
        ]);
        return $this->success('Post created successfully', route('post.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post, $id)
    {
        $post = Post::find($id);
        return Inertia::render('post/Edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'body' => 'required',
            ],
            [
                'title.required' => 'Title is required',
                'body.required' => 'Body is required',
                
            ],
        );
        $errors = $validator->errors();
        if ($errors->any()) {
            return $this->validationError($errors->first());
        }
        $post = Post::find($id);
       
        $post->update([
            'title' => $request->title,
            'body' => $request->body
        ]);

        return $this->success('Post update successfully', route('post.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post, $id)
    {
        $post = Post::find($id);
        $post->delete();
       return $this->success('Post deleted successfully', route('post.index'));
    }
}
