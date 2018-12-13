<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// 要先使用 Post 這個 model 才能使用 Post::all()
use App\Post;
use Log;
use Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Post::all();
        return Post::simplePaginate(5);
        // return view('post', [
        //     'title' => 'List all my post',
        //     'posts' => Post::all()
        // ]);
    }
    public function list()
    {
        return view('post.post-list',[
            'postData' => Post::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function new()
    {
        return view('post.post-new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        Log::debug($request->all());
        $validate = Validator::make($request->all(), [
            'title'=>'required',
            'note'=>'required',
        ]);
        // return $validate->errors();
        if ($validate->fails()) {
            return view('post.post-new',
                ['errors' => $validate->errors()
            ]);
        }
        Post::create([
            'title' => $request->title,
            'content' => $request->note
        ]);
        return view('post.post-new');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // find 方法會用傳入的值(id)來篩選資料
        // $post = Post::find($id);
        // if($post == null)
        //     abort(404);
        // return $post;
        return Post::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::destroy($id);
        return redirect('/products/job/content/');
    }
}
