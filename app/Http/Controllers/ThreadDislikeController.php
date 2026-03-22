<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\ThreadDislike;
use Illuminate\Http\Request;

class ThreadDislikeController extends Controller
{
    public function toggle(Request $request, Thread $thread)
    {
        $existingDislike = ThreadDislike::where('user_id', auth()->id())
            ->where('thread_id', $thread->id)
            ->first();

        $disliked = false;

        if ($existingDislike) {
            $existingDislike->delete();
            $disliked = false;
        } else {
            ThreadDislike::create([
                'user_id' => auth()->id(),
                'thread_id' => $thread->id,
            ]);

            // remove like if user had liked before
            $thread->likes()->where('user_id', auth()->id())->delete();

            $disliked = true;
        }

        $thread->loadCount(['likes', 'dislikes']);

        if ($request->expectsJson()) {
            return response()->json([
                'disliked' => $disliked,
                'likes_count' => $thread->likes_count,
                'dislikes_count' => $thread->dislikes_count,
            ]);
        }

        return back();
    }
//    public function toggle(Thread $thread)
//    {
//        $existingDislike = ThreadDislike::where('user_id', auth()->id())
//            ->where('thread_id', $thread->id)
//            ->first();
//
//        if ($existingDislike) {
//            $existingDislike->delete();
//        } else {
//            ThreadDislike::create([
//                'user_id' => auth()->id(),
//                'thread_id' => $thread->id,
//            ]);
//
//            // remove like if user had liked before
//            $thread->likes()->where('user_id', auth()->id())->delete();
//        }
//
//        return back();
//    }
}
