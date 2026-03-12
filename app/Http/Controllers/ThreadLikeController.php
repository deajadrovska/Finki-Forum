<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\ThreadLike;
use Illuminate\Http\Request;

class ThreadLikeController extends Controller
{
    public function store(Thread $thread)
    {
        $existingLike = ThreadLike::where('thread_id', $thread->id)
            ->where('user_id', auth()->id())
            ->first();

        if ($existingLike) {
            $existingLike->delete();
        } else {
            ThreadLike::create([
                'thread_id' => $thread->id,
                'user_id' => auth()->id(),
            ]);
        }

        return redirect()->back();
    }
}
