@extends('layouts.app')

@section('title', 'Search results for "' . $query . '"')

@section('content')

    <section class="section">
        <div style="margin-bottom:1.5rem;">
            <h1 style="margin-bottom:0.25rem;">
                Search results for "<span style="color:var(--primary);">{{ $query }}</span>"
            </h1>
            <p style="color:var(--muted-fg);font-size:0.875rem;">
                {{ $subjects->count() + $threads->count() }} result(s) found
            </p>
        </div>

        {{-- Subjects --}}
        <div style="margin-bottom:2.5rem;">
            <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:1rem;padding-bottom:0.5rem;border-bottom:2px solid var(--border);">
                <h2 style="margin:0;">Subjects</h2>
                <span class="badge badge-secondary">{{ $subjects->count() }}</span>
            </div>

            @if($subjects->isEmpty())
                <p style="color:var(--muted-fg);font-size:0.875rem;">No subjects found.</p>
            @else
                <div class="grid-4">
                    @foreach($subjects as $subject)
                        <a href="{{ route('subjects.show', $subject->id) }}"
                           class="card category-card"
                           style="padding:1.25rem;display:flex;flex-direction:column;gap:0.75rem;">

                            <div style="display:flex;align-items:center;gap:0.75rem;">
                                <div class="category-icon">
                                    <i data-lucide="book-open" class="icon-md"></i>
                                </div>
                                <h3 style="margin:0;font-size:1rem;font-weight:600;color:#1e293b;">
                                    {{ $subject->name }}
                                </h3>
                            </div>

                            <div style="font-size:0.875rem;color:#334155;">
                                {{ $subject->semester->name }}
                            </div>

                            @if($subject->majors->isNotEmpty())
                                <div style="display:flex;flex-wrap:wrap;gap:6px;">
                                    @foreach($subject->majors as $major)
                                        <span style="
                                            font-size:0.75rem;
                                            padding:3px 8px;
                                            border-radius:20px;
                                            background:#eef2ff;
                                            color:#3730a3;
                                            font-weight:600;
                                            border:1px solid #c7d2fe;
                                        ">
                                            {{ $major->code }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif

                            <div style="margin-top:auto;padding-top:0.5rem;border-top:1px solid #e5e7eb;font-size:0.875rem;">
                                <span style="color:#1e293b;font-weight:600;">
                                    {{ $subject->threads_count ?? 0 }}
                                    <span style="font-weight:400;">threads</span>
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Threads --}}
        <div>
            <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:1rem;padding-bottom:0.5rem;border-bottom:2px solid var(--border);">
                <h2 style="margin:0;">Threads</h2>
                <span class="badge badge-secondary">{{ $threads->count() }}</span>
            </div>

            @if($threads->isEmpty())
                <p style="color:var(--muted-fg);font-size:0.875rem;">No threads found.</p>
            @else
                <div class="stack-sm">
                    @foreach($threads as $thread)
                        <div class="card thread-card" style="padding:1rem;">
                            <div class="thread-content">
                                <div class="thread-badges" style="margin-bottom:0.5rem;">
                                    <span class="badge badge-outline">{{ $thread->subject->name }}</span>
                                    <span class="badge badge-secondary">{{ $thread->subject->semester->name }}</span>
                                </div>

                                @if($thread->tags->isNotEmpty())
                                    <div class="thread-tags" style="margin-bottom:0.5rem;">
                                        @foreach($thread->tags as $tag)
                                            <span class="badge badge-primary">{{ $tag->name }}</span>
                                        @endforeach
                                    </div>
                                @endif

                                <h3 style="margin-bottom:0.5rem;">
                                    <a href="{{ route('threads.show', $thread->id) }}" style="text-decoration:none;color:inherit;">
                                        {{ $thread->title }}
                                    </a>
                                </h3>

                                <p class="thread-excerpt line-clamp-2">
                                    {{ $thread->content }}
                                </p>

                                <div class="thread-meta" style="margin-bottom:1rem;">
                                    <span class="thread-meta-item">
                                        @if($thread->is_anonymous)
                                            <span class="avatar avatar-sm avatar-primary">AN</span>
                                            Anonymous
                                        @else
                                            <span class="avatar avatar-sm avatar-primary">
                                                {{ strtoupper(substr($thread->user->name, 0, 2)) }}
                                            </span>
                                            {{ $thread->user->name }}
                                        @endif
                                    </span>

                                    <span class="thread-meta-item">
                                        <i data-lucide="clock" class="icon-sm"></i>
                                        {{ $thread->created_at->diffForHumans() }}
                                    </span>
                                </div>

                                <div style="display:flex;align-items:center;gap:1rem;padding-top:0.75rem;border-top:1px solid var(--border);">
                                    <span class="post-stat">
                                        <i data-lucide="heart" class="icon"></i>
                                        {{ $thread->likes->count() }} likes
                                    </span>
                                    <span class="post-stat">
                                        <i data-lucide="message-square" class="icon"></i>
                                        {{ $thread->replies->count() }} replies
                                    </span>
                                    <a href="{{ route('threads.show', $thread->id) }}" class="btn btn-primary btn-sm" style="margin-left:auto;">
                                        Open
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </section>

@endsection
