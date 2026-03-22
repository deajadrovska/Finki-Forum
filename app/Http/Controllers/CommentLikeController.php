<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentLike;
use Illuminate\Http\Request;

class CommentLikeController extends Controller
{

    public function toggle(Request $request, Comment $comment)
    {
        $existingLike = CommentLike::where('user_id', auth()->id())
            ->where('comment_id', $comment->id)
            ->first();

        $liked = false;

        if ($existingLike) {
            $existingLike->delete();
            $liked = false;
        } else {
            CommentLike::create([
                'user_id' => auth()->id(),
                'comment_id' => $comment->id,
            ]);

            // remove dislike if exists
            $comment->dislikes()->where('user_id', auth()->id())->delete();

            $liked = true;
        }

        $comment->loadCount(['likes', 'dislikes']);

        // IMPORTANT for fetch()
        if ($request->expectsJson()) {
            return response()->json([
                'liked' => $liked,
                'likes_count' => $comment->likes_count,
                'dislikes_count' => $comment->dislikes_count,
            ]);
        }

        return back();
    }
//    public function toggle(Comment $comment)
//    {
//        $existingLike = CommentLike::where('user_id', auth()->id())
//            ->where('comment_id', $comment->id)
//            ->first();
//
//        if ($existingLike) {
//            $existingLike->delete();
//        } else {
//            CommentLike::create([
//                'user_id' => auth()->id(),
//                'comment_id' => $comment->id,
//            ]);
//        }
//
//        return back();
//    }
}
