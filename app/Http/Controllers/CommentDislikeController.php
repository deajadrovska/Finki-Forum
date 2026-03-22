<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentDislike;
use Illuminate\Http\Request;

class CommentDislikeController extends Controller
{

    public function toggle(Request $request, Comment $comment)
    {
        $existingDislike = CommentDislike::where('user_id', auth()->id())
            ->where('comment_id', $comment->id)
            ->first();

        $disliked = false;

        if ($existingDislike) {
            $existingDislike->delete();
            $disliked = false;
        } else {
            CommentDislike::create([
                'user_id' => auth()->id(),
                'comment_id' => $comment->id,
            ]);

            // remove like if user had liked before
            $comment->likes()->where('user_id', auth()->id())->delete();

            $disliked = true;
        }

        $comment->loadCount(['likes', 'dislikes']);

        if ($request->expectsJson()) {
            return response()->json([
                'disliked' => $disliked,
                'likes_count' => $comment->likes_count,
                'dislikes_count' => $comment->dislikes_count,
            ]);
        }

        return back();
    }
//    public function toggle(Comment $comment)
//    {
//        $existingDislike = CommentDislike::where('user_id', auth()->id())
//            ->where('comment_id', $comment->id)
//            ->first();
//
//        if ($existingDislike) {
//            $existingDislike->delete();
//        } else {
//            CommentDislike::create([
//                'user_id' => auth()->id(),
//                'comment_id' => $comment->id,
//            ]);
//
//            // remove like if user had liked before
//            $comment->likes()->where('user_id', auth()->id())->delete();
//        }
//
//        return back();
//    }
}
