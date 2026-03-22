<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\ThreadLike;
use Illuminate\Http\Request;

class ThreadLikeController extends Controller
{




    public function store(Request $request, Thread $thread)
    {
        $existingLike = ThreadLike::where('thread_id', $thread->id)
            ->where('user_id', auth()->id())
            ->first();

        $liked = false;

        if ($existingLike) {
            $existingLike->delete();
            $liked = false;
        } else {
            ThreadLike::create([
                'thread_id' => $thread->id,
                'user_id' => auth()->id(),
            ]);

            $thread->dislikes()->where('user_id', auth()->id())->delete();
            $liked = true;
        }

        $thread->loadCount(['likes', 'dislikes']);

        if ($request->expectsJson()) {
            return response()->json([
                'liked' => $liked,
                'likes_count' => $thread->likes_count,
                'dislikes_count' => $thread->dislikes_count,
            ]);
        }

        return redirect()->back();
    }
//    public function store(Thread $thread)
//    {
//        $existingLike = ThreadLike::where('thread_id', $thread->id)
//            ->where('user_id', auth()->id())
//            ->first();
//
//        if ($existingLike) {
//            $existingLike->delete();
//        } else {
//            ThreadLike::create([
//                'thread_id' => $thread->id,
//                'user_id' => auth()->id(),
//            ]);
//
//
//            $thread->dislikes()->where('user_id', auth()->id())->delete();
//        }
//
//        return redirect()->back();
//    }
}
