<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(Request $request, Thread $thread)
    {
        $request->validate([
            'content' => 'required|string'
        ]);

        Reply::create([
            'thread_id' => $thread->id,
            'user_id' => auth()->id(),
            'content' => $request->input('content'),
        ]);

        return redirect()->back();
    }
}
