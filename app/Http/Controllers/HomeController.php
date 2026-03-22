<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Major;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\Tag;
use App\Models\Thread;

class HomeController extends Controller
{
    public function index()
    {
        $totalSubjects = Subject::count();
        $totalMajors = Major::count();
        $totalSemesters = Semester::count();
        $totalThreads = Thread::count();
        $totalComments = Comment::count();

        $recentThreads = Thread::with([
            'user',
            'subject',
            'tags',
            'likes',
        ])
            ->withCount(['comments'])
            ->latest()
            ->take(4)
            ->get();

        $trendingThreads = Thread::with(['subject'])
            ->withCount(['likes'])
            ->orderByDesc('likes_count')
            ->take(3)
            ->get();

        $activeSubjects = Subject::with('semester')
            ->withCount('threads')
            ->orderByDesc('threads_count')
            ->take(4)
            ->get();

        $popularTags = Tag::withCount('threads')
            ->orderByDesc('threads_count')
            ->take(10)
            ->get();

        return view('home', compact(
            'totalSubjects',
            'totalMajors',
            'totalSemesters',
            'totalThreads',
            'totalComments',
            'recentThreads',
            'trendingThreads',
            'activeSubjects',
            'popularTags'
        ));
    }
}
