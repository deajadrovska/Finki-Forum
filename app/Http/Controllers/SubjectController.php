<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Tag;

class SubjectController extends Controller
{
    public function index()
    {
        $semesters = \App\Models\Semester::with(['subjects' => function($query) {
            $query->with('majors')->withCount('threads');
        }])
            ->orderBy('name')
            ->get();

        return view('subjects.index', compact('semesters'));
    }

    public function show($id)
    {
        $subject = Subject::with([
            'semester',
            'threads.user',
            'threads.likes',
            'threads.replies',
            'threads.tags',
        ])->findOrFail($id);

        $tags = Tag::all();

        $selectedTag = request('tag');

        $threads = $subject->threads;

        if ($selectedTag) {
            $threads = $threads->filter(function ($thread) use ($selectedTag) {
                return $thread->tags->contains('name', $selectedTag);
            });
        }

        return view('subjects.show', compact('subject', 'tags', 'threads', 'selectedTag'));
    }
}
