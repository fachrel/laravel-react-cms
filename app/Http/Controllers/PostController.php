<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user:id,username', 'category:id,name'])->get();
        // return $posts;
        return PostResource::collection($posts);
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            // 'user_id'     => 'required',
            'category' => 'required',
            'title'       => 'required',
            'content'     => 'required',
            'photo'       => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        $imageName = null;
    
        if ($request->file('photo')) {
            $image = $request->file('photo');
    
            // Generate a unique name for the file
            $imageName = time() . '.' . $image->getClientOriginalExtension();
    
            // Move the file to the storage path
            $image->move(public_path('posts'), $imageName);
        }
    
        $post = Post::create([
            'user_id'       => '1',
            'category_id'   => $request->category,
            'title'         => $request->title,
            'content'       => $request->content,
            'photo'         => $imageName,
        ]);
    
        return new PostResource($post, 'Data Post Berhasil Ditambahkan!');
    }
    
}
