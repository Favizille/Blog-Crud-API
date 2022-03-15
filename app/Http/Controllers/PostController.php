<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //also known as show
    public function viewAllPost(){
        //returns all the post
        $post = Post::all();
        return $post;
    }

    //also known as store
    public function createPost(Request $request){
        $request->validate([
            "slug"=>"required",
            "title" => "required",
            "description" => "required",
            "image_path" => "required",
        ]);

        //to create a post requiring all the fields to be filled
        $created_post = Post::create($request->all());
        return $created_post;
    }

    public function searchPost($slug){

       $post =  Post::where('title', 'like', '%'.$slug.'%')

        ->orWhere('slug', 'like', '%'.$slug.'%')
        ->orWhere('description', 'like', '%'.$slug.'%')->get();


        return response()->json([
            'status'=>'success',
            'message'=>$post
        ]);
    }

    public function editPost(Request $request, $id){
        $post = Post::find($id);
        $post->update($request->all());


        return response()->json([
            'status' => 'success',
            'message' => $post
        ]);
    }

    public function deletePost($id){
        //get post by id then delete post
        $post= Post::find($id);
        $post->delete();

        return response()->json([
            'status'=> 'success',
            'message'=>$post
        ]);
    }
}
