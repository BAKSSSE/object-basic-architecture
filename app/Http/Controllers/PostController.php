<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
// use App\Http\Requests\PostRequest;

class PostController extends Controller
{

    public function index() {
        $posts = Post::orderBy('created_at', 'desc')
                        ->with(['comments','categories','comments.user', 'user'])
                        ->paginate(10);

        logger($posts);
                        
        // $filtered = $posts->filter(function($value) {
        //     return $value->id % 2 === 0;
        // });
        // return $filtered;

        return response()->json( 
            $posts
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
        $params = $request->only([
            'subject', 'content'
        ]);

        $params['user_id'] = $request->user()->id;

        $post = Post::create($params);

        $ids = $request->input('category_ids');
        $post->categories()->sync($ids);

        $result = Post::where('id', $post->id)->with(['user','categories'])->get();

        // dd($request->input('category_id'));
        
        // $subject = $request->input('subject');
        // $content = $request->input('content');

        // $post = new Post();
        // $post->subject = $subject;
        // $post->content = $content;
        // $post->save();

        

        return response()->json($result);
    }

    public function read($id) {
        // $post = Post::find($id);
        $post = Post::where('id', $id)->with('comments', 'comments.user', 'user')->first();
        
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

        $user = $request->user();

        if ($user->id != $post->user_id) {
            return response()->json([
                'message' => '삭제 할 수 없습니다.'
            ], 403);
        }

        $subject = $request->input('subject');
        $content = $request->input('content');

        if ($subject) $post->subject = $subject;
        if ($content) $post->content = $content;

        $ids = $request->input('category_ids');

        $post->save();
        $post->categories()->sync($ids);

        return response()->json(
            $post
        );

    }

    public function delete(Request $request, $id) {
        $post = Post::find($id);
        if (!$post) {
            return response()->json([
                // 'result' => true,
                'message' => '데이터 없음'
                ], 404);
        }


        $user = $request->user();
        if ($user->id != $post->user_id) {
            return response()->json([
                'message' => '삭제 할 수 없습니다.'
            ], 403);
        }

        $post->delete();

        return response()->json([
            'message' => '삭제'
        ]);
    }
}
