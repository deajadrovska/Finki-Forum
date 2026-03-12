<?php

namespace App\Http\Controllers;

use App\Models\Major;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    public function index()
    {
        $majors = Major::withCount('subjects')->get();

        return view('majors.index', compact('majors'));
    }

    public function show(Major $major)
    {
        $major->load([
            'subjects.semester',
        ]);

        $threads = \App\Models\Thread::whereIn(
            'subject_id',
            $major->subjects->pluck('id')
        )
            ->with(['user', 'likes', 'replies', 'subject'])
            ->latest()
            ->take(10)
            ->get();

        return view('majors.show', compact('major', 'threads'));
    }
}
