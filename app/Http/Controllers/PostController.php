<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    public function index() {
        $post = Post::orderBy('created_at', 'desc')
                        ->with('comments')
                        ->get();
        
        return response()->json( 
            $post
        );
    }
    
    public function create(Request $request) {
        // $request->validate([
        //     'subject' => 'required',
        //     'content' => 'required'
        // ]);

        $validator = Validator::make($request->all(), [
            'subject' => 'required',
            'content' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => '데이터 없음'
                ], 404);
        }

        $subject = $request->input('subject');
        $content = $request->input('content');

        $post = new Post();
        $post->subject = $subject;
        $post->content = $content;
        $post->save();
        return response()->json($post);
    }

    public function read($id) {
        // $post = Post::find($id);
        $post = Post::where('id', $id)->with('comments')->first();
        
        if (!$post) {
            return response()->json([
                'message' => '데이터 없음'
                ], 404);
        }

        return response()->json(
            $post
        );
    }

    public function update(Request $request, $id) {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                // 'result' => true,
                'message' => '데이터 없음'
                ], 404);
        }
        $subject = $request->input('subject');
        $content = $request->input('content');

        if ($subject) $post->subject = $subject;
        if ($content) $post->content = $content;

        $post->save();

        return response()->json(
            $post
        );

    }

    public function delete($id) {
        $post = Post::find($id);
        if (!$post) {
            return response()->json([
                // 'result' => true,
                'message' => '데이터 없음'
                ], 404);
        }

        $post->delete();

        return response()->json([
            'message' => '삭제'
        ]);
    }
}
