<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Thread;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');

        if (!$query) {
            return redirect()->route('home');
        }

        $subjects = Subject::with(['semester', 'majors'])
            ->withCount('threads')
            ->where('name', 'like', '%' . $query . '%')
            ->get();

        $threads = Thread::with(['subject', 'user', 'likes', 'replies', 'tags'])
            ->where(function($q) use ($query) {
                $q->where('title', 'like', '%' . $query . '%')
                    ->orWhere('content', 'like', '%' . $query . '%');
            })
            ->latest()
            ->get();

        return view('search.results', compact('query', 'subjects', 'threads'));
    }
}
