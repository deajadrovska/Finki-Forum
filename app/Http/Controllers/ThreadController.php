<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Thread;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
//    public function show($id)
//    {
//        $thread = Thread::with(['user', 'subject.semester'])->findOrFail($id);
//
//        return view('threads.show', compact('thread'));
//    }
    public function show(Thread $thread)
    {
        $thread->load(['replies.user', 'likes']);

        $isLiked = auth()->check()
            ? $thread->likes->contains('user_id', auth()->id())
            : false;

        return view('threads.show', compact('thread', 'isLiked'));
    }

    public function create()
    {
        $subjects = Subject::all();

        return view('threads.create', compact('subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        $thread = Thread::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'subject_id' => $request->input('subject_id'),
            'user_id' => auth()->id() ?? 1,
        ]);

        return redirect()->route('threads.show', $thread->id);
    }
}
