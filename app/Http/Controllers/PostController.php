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
      
        return Inertia::render('post/Post');
    }

    public function postData(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'title',
            2 => 'body',
        ];
        $totalData = Post::count();
        $totalFiltered = $totalData;
        if ($request->input('pagesize') != 'All') {
            $limit = $request->input('pagesize');
        } else {
            $limit = $totalData;
        }
        $current_page = $request->input('current_page'); 
        $column = $request->input('sort_column'); 
        $dir = $request->input('sort_direction'); //asc or desc

        if (empty($request->input('search'))) {
            $posts = Post::offset($current_page)->limit($limit)->orderBy($column, $dir)->get();
        } else {
            $search = $request->input('search');
            $posts = Post::where('title', 'LIKE', "%{$search}%")
                ->orWhere('body', 'LIKE', "%{$search}%")
                ->offset($current_page)
                ->limit($limit)
                ->orderBy($column, $dir)
                ->get();
            $totalFiltered = Post::where('title', 'LIKE', "%{$search}%")
                ->orWhere('body', 'LIKE', "%{$search}%")
                ->count();
        }
        $data = [];
        if (!empty($posts)) {
            foreach ($posts as $key => $post) {
                $nestedData['id'] = $post->id;
                $nestedData['keyCount'] =  $key + 1;
                $nestedData['key'] = $key ;
                $nestedData['title'] = $post->title;
                $nestedData['body'] = $post->body;
                $data[] = $nestedData;
                $nestedData['keyCount']++;
            }
        }
        return response()->json([
            // "draw"            => intval($request->input('draw')),
            'recordsTotal' => intval($totalData),
            'recordsFiltered' => intval($totalFiltered),
            'data' => $data,
        ]);
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
