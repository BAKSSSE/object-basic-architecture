<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    //

    public function create(Request $request, $postId) {
        $post = Post::find($postId);

        if (!$post) {
            return abort(404);
        }

        $user = $request->user();
        $content = $request->input('content');

        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->post_id = $post->id;
        $comment->content = $content;
        $comment->save();

        return response()->json(
            $comment
        );

    }

    public function delete($postId, $id) {
        $comment = Comment::where('post_id', $postId)->where('id', $id)->first();
        if (!comment) abort(404);

        $user = $request->user();

        if ($user->id != $comment->user_id) {
            abort(404);
        }
        $comment->delete();

        return response()->json([
            'message' => '삭제'
        ]);
    }
}
