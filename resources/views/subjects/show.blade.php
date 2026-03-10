@extends('layouts.app')

@section('title', $subject->name)

@section('content')

    <section class="section">
        <div style="margin-bottom: 2rem;">
            <h1>{{ $subject->name }}</h1>
            <p>{{ $subject->semester->name }}</p>
        </div>

        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;">
            <h2>Threads</h2>
        </div>

        @if($subject->threads->isEmpty())
            <div class="card" style="padding: 1.5rem;">
                <h3>No threads yet</h3>
                <p>This subject does not have any discussions yet.</p>
            </div>
        @else
            <div class="stack-sm">
                @foreach($subject->threads as $thread)
                    <a href="{{ route('threads.show', $thread->id) }}" class="card thread-card">
                        <div class="thread-content">
                            <div class="thread-badges">
                                <span class="badge badge-outline">{{ $subject->name }}</span>
                            </div>

                            <h3>{{ $thread->title }}</h3>

                            <p class="thread-excerpt line-clamp-2">
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
                    </a>
                @endforeach
            </div>
        @endif
    </section>

@endsection
