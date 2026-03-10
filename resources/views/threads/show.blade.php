@extends('layouts.app')

@section('title', $thread->title)

@section('content')

    <section class="section">
        <div style="margin-bottom: 1rem;">
            <a href="{{ route('subjects.show', $thread->subject->id) }}" class="btn btn-ghost btn-sm">
                ← Back to {{ $thread->subject->name }}
            </a>
        </div>

        <div class="card" style="padding: 1.5rem;">
            <div class="thread-badges" style="margin-bottom: 1rem;">
                <span class="badge badge-outline">{{ $thread->subject->name }}</span>
                <span class="badge badge-secondary">{{ $thread->subject->semester->name }}</span>
            </div>

            <h1 style="margin-bottom: 1rem;">{{ $thread->title }}</h1>

            <p style="margin-bottom: 1.5rem; white-space: pre-line;">
                {{ $thread->content }}
            </p>

            <div class="thread-meta">
            <span class="thread-meta-item">
                <span class="avatar avatar-sm avatar-primary">
                    {{ strtoupper(substr($thread->user->name, 0, 2)) }}
                </span>
                {{ $thread->user->name }}
            </span>

                <span class="thread-meta-item">
                <i data-lucide="clock" class="icon-sm"></i>
                {{ $thread->created_at->diffForHumans() }}
            </span>
            </div>
        </div>

        <div class="card" style="padding: 1.5rem; margin-top: 1.5rem;">
            <h2>Replies</h2>
            <p>Replies will be added later.</p>
        </div>
    </section>

@endsection
