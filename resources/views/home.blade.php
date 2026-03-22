@extends('layouts.app')

@section('title', 'FINKI Forum - Home')

@section('content')

    <section class="hero section">
        <div style="display:flex;align-items:center;justify-content:space-between;gap:2rem;flex-wrap:wrap;">
            <div style="flex:1;min-width:280px;">
                <h1 class="text-balance">Welcome to FINKI Forum</h1>
                <p class="text-pretty">
                    Connect with fellow students, discuss coursework, share resources, and get help with your studies. Join the conversation!
                </p>

                <div class="hero-actions">
                    <a href="{{ route('subjects.index') }}" class="btn btn-primary">
                        Browse Subjects <i data-lucide="arrow-right" class="icon"></i>
                    </a>
                    <a href="{{ route('threads.create') }}" class="btn btn-outline">Start a Discussion</a>
                </div>
            </div>

            <div style="flex:0 0 280px;display:flex;justify-content:center;">
                <img
                    src="{{ asset('images/forum-logo.png') }}"
                    alt="FINKI Forum Logo"
                    style="max-width:280px;width:100%;height:auto;display:block;"
                >
            </div>
        </div>
    </section>

    <section class="section">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;">
            <h2>Categories</h2>
        </div>

        <div class="grid-4">
            <a href="{{ route('subjects.index') }}" class="card category-card">
                <div class="category-icon"><i data-lucide="book-open" class="icon-md"></i></div>
                <h3>Subjects</h3>
                <p>Discuss course materials, assignments, and exams</p>
                <div class="category-stats">
                    <span>{{ $totalSubjects }} subjects</span>
                    <span>{{ $totalThreads }} threads</span>
                </div>
            </a>

            <a href="{{ route('majors.index') }}" class="card category-card">
                <div class="category-icon"><i data-lucide="graduation-cap" class="icon-md"></i></div>
                <h3>Majors & Tracks</h3>
                <p>Explore discussions and subjects by study program</p>
                <div class="category-stats">
                    <span>{{ $totalMajors }} majors</span>
                    <span>Study programs</span>
                </div>
            </a>

            <a href="{{ route('semesters.index') }}" class="card category-card">
                <div class="category-icon"><i data-lucide="calendar" class="icon-md"></i></div>
                <h3>Semesters</h3>
                <p>Semester-specific subjects and resources</p>
                <div class="category-stats">
                    <span>{{ $totalSemesters }} semesters</span>
                    <span>Structured browsing</span>
                </div>
            </a>

            <a href="{{ route('subjects.index') }}" class="card category-card">
                <div class="category-icon"><i data-lucide="users" class="icon-md"></i></div>
                <h3>General</h3>
                <p>Forum-wide student discussions and shared resources</p>
                <div class="category-stats">
                    <span>{{ $totalThreads }} threads</span>
                    <span>{{ $totalComments }} comments</span>
                </div>
            </a>
        </div>
    </section>

    <div class="grid-main-sidebar">
        <section>
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;">
                <div style="display:flex;align-items:center;gap:0.5rem;">
                    <i data-lucide="clock" class="icon-md" style="color:var(--primary)"></i>
                    <h2>Recent Discussions</h2>
                </div>

                <a href="{{ route('subjects.index') }}" class="btn btn-ghost btn-sm">
                    View all <i data-lucide="arrow-right" class="icon-sm"></i>
                </a>
            </div>

            @if($recentThreads->isEmpty())
                <div class="card" style="padding:1.5rem;">
                    <p>No discussions yet.</p>
                </div>
            @else
                <div class="stack-sm">
                    @foreach($recentThreads as $thread)
                        <a href="{{ route('threads.show', $thread) }}" class="card thread-card">
                            <div class="thread-votes">
                                <div class="btn btn-ghost btn-icon btn-sm">
                                    <i data-lucide="arrow-up" class="icon-md"></i>
                                </div>
                                <span class="vote-count">{{ $thread->likes->count() }}</span>
                                <div class="btn btn-ghost btn-icon btn-sm">
                                    <i data-lucide="arrow-down" class="icon-md"></i>
                                </div>
                            </div>

                            <div class="thread-content">
                                <div class="thread-badges">
                                    @if($thread->subject)
                                        <span class="badge badge-outline">{{ $thread->subject->name }}</span>
                                    @endif
                                </div>

                                <h3>{{ $thread->title }}</h3>

                                <p class="thread-excerpt line-clamp-2">
                                    {{ $thread->content }}
                                </p>

                                <div class="thread-meta">
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
                                        <i data-lucide="message-square" class="icon-sm"></i>
                                        {{ $thread->comments_count }} comments
                                    </span>

                                    <span class="thread-meta-item">
                                        <i data-lucide="clock" class="icon-sm"></i>
                                        {{ $thread->created_at->diffForHumans() }}
                                    </span>
                                </div>

                                @if($thread->tags->isNotEmpty())
                                    <div class="thread-tags">
                                        @foreach($thread->tags->take(3) as $tag)
                                            <span class="badge badge-secondary">{{ $tag->name }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </section>

        <aside>
            <div class="sidebar-section">
                <h2><i data-lucide="trending-up" class="icon-md"></i> Trending</h2>

                @if($trendingThreads->isEmpty())
                    <p>No trending threads yet.</p>
                @else
                    <div class="stack-sm">
                        @foreach($trendingThreads as $index => $thread)
                            <a href="{{ route('threads.show', $thread) }}" class="trending-item">
                                <span class="trending-number">{{ $index + 1 }}</span>
                                <div>
                                    <p class="trending-title line-clamp-2">{{ $thread->title }}</p>
                                    <p class="trending-upvotes">{{ $thread->likes_count }} likes</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="sidebar-section">
                <h2><i data-lucide="message-square" class="icon-md"></i> Active Subjects</h2>

                @if($activeSubjects->isEmpty())
                    <p>No active subjects yet.</p>
                @else
                    <div class="stack-sm">
                        @foreach($activeSubjects as $subject)
                            <a href="{{ route('subjects.show', $subject) }}" class="active-subject-item">
                                <div>
                                    <p class="active-subject-name">{{ $subject->name }}</p>
                                    <p class="active-subject-threads">{{ $subject->threads_count }} threads</p>
                                </div>

                                @if($subject->semester)
                                    <span class="badge badge-outline">{{ $subject->semester->name }}</span>
                                @endif
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="sidebar-section">
                <h2>Popular Tags</h2>

                @if($popularTags->isEmpty())
                    <p>No tags yet.</p>
                @else
                    <div class="tag-cloud">
                        @foreach($popularTags as $tag)
                            <a href="{{ route('search', ['tag' => $tag->name]) }}" class="badge badge-secondary">
                                {{ $tag->name }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </aside>
    </div>

@endsection
