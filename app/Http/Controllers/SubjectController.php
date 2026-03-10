<?php

namespace App\Http\Controllers;

use App\Models\Subject;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::with('semester')
            ->withCount('threads')
            ->get();

        return view('subjects.index', compact('subjects'));
    }
    public function show($id)
    {
        $subject = \App\Models\Subject::with('semester')->findOrFail($id);

        return view('subjects.show', compact('subject'));
    }
}
