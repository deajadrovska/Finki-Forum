<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    public function show($id)
    {
        $thread = Thread::with(['user', 'subject.semester'])->findOrFail($id);

        return view('threads.show', compact('thread'));
    }
}
