<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class CommentsController extends Controller
{
    use AuthorizesRequests;
    public function store(Request $request, Thread $thread)
    {
        $validated = $request->validate([
            'content' => ['required', 'string', 'max:2000'],
            'is_anonymous' => ['nullable', 'boolean'],
        ]);

        Comment::create([
            'content' => $validated['content'],
            'user_id' => auth()->id(),
            'thread_id' => $thread->id,
            'parent_id' => null,
            'is_anonymous' => $validated['is_anonymous'] ?? false,
        ]);

        return back()->with('success', 'Comment added successfully.');
    }

    public function reply(Request $request, Comment $comment)
    {
        $validated = $request->validate([
            'content' => ['required', 'string', 'max:2000'],
            'is_anonymous' => ['nullable', 'boolean'],
        ]);
        if ($comment->parent_id !== null) {
            abort(403, 'You can only reply to a top-level comment for now.');
        }
        Comment::create([
            'content' => $validated['content'],
            'user_id' => auth()->id(),
            'thread_id' => $comment->thread_id,
            'parent_id' => $comment->id,
            'is_anonymous' => $validated['is_anonymous'] ?? false,
        ]);

        return back()->with('success', 'Reply added successfully.');
    }

    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $validated = $request->validate([
            'content' => ['required', 'string', 'max:2000'],
        ]);

        $comment->update([
            'content' => $validated['content'],
        ]);

        return back()->with('success', 'Comment updated successfully.');
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return back()->with('success', 'Comment deleted successfully.');
    }
}
