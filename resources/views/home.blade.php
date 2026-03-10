@extends('layouts.app')

@section('title', 'FINKI Forum - Home')

@section('content')

    <!-- Hero Section -->
    <section class="hero section">
        <h1 class="text-balance">Welcome to FINKI Forum</h1>
        <p class="text-pretty">
            Connect with fellow students, discuss coursework, share resources, and get help with your studies. Join the conversation!
        </p>
        <div class="hero-actions">
            <a href="{{ route('subjects.index') }}" class="btn btn-primary">
                Browse Subjects <i data-lucide="arrow-right" class="icon"></i>
            </a>
            <a href="#" class="btn btn-outline">Start a Discussion</a>
        </div>
    </section>

    <!-- Categories Grid -->
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
                    <span>1,247 threads</span>
                    <span>8,934 posts</span>
                </div>
            </a>

            <a href="{{ route('subjects.index') }}" class="card category-card">
                <div class="category-icon"><i data-lucide="graduation-cap" class="icon-md"></i></div>
                <h3>Majors &amp; Tracks</h3>
                <p>Information about different study programs</p>
                <div class="category-stats">
                    <span>342 threads</span>
                    <span>2,156 posts</span>
                </div>
            </a>

            <a href="{{ route('subjects.index') }}" class="card category-card">
                <div class="category-icon"><i data-lucide="calendar" class="icon-md"></i></div>
                <h3>Semesters</h3>
                <p>Semester-specific discussions and resources</p>
                <div class="category-stats">
                    <span>567 threads</span>
                    <span>4,521 posts</span>
                </div>
            </a>

            <a href="{{ route('subjects.index') }}" class="card category-card">
                <div class="category-icon"><i data-lucide="users" class="icon-md"></i></div>
                <h3>General</h3>
                <p>Campus life, events, and student resources</p>
                <div class="category-stats">
                    <span>891 threads</span>
                    <span>6,789 posts</span>
                </div>
            </a>
        </div>
    </section>

    <!-- Main + Sidebar -->
    <div class="grid-main-sidebar">

        <!-- Recent Threads -->
        <section>
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;">
                <div style="display:flex;align-items:center;gap:0.5rem;">
                    <i data-lucide="clock" class="icon-md" style="color:var(--primary)"></i>
                    <h2>Recent Discussions</h2>
                </div>
                <a href="{{ route('subjects.index') }}" class="btn btn-ghost btn-sm">View all <i data-lucide="arrow-right" class="icon-sm"></i></a>
            </div>

            <div class="stack-sm">
                <a href="#" class="card thread-card">
                    <div class="thread-votes">
                        <button class="btn btn-ghost btn-icon btn-sm"><i data-lucide="arrow-up" class="icon-md"></i></button>
                        <span class="vote-count">43</span>
                        <button class="btn btn-ghost btn-icon btn-sm"><i data-lucide="arrow-down" class="icon-md"></i></button>
                    </div>
                    <div class="thread-content">
                        <div class="thread-badges">
                            <span class="badge badge-primary"><i data-lucide="pin" class="icon-sm"></i> Pinned</span>
                            <span class="badge badge-outline">Structured Programming</span>
                        </div>
                        <h3>How to approach the midterm exam preparation?</h3>
                        <p class="thread-excerpt line-clamp-2">Hey everyone! The midterm for Structured Programming is coming up next week. What topics should I focus on?</p>
                        <div class="thread-meta">
                        <span class="thread-meta-item">
                            <span class="avatar avatar-sm avatar-primary">MJ</span>
                            Maria Jovanovska
                        </span>
                            <span class="thread-meta-item"><i data-lucide="message-square" class="icon-sm"></i> 23 replies</span>
                            <span class="thread-meta-item"><i data-lucide="eye" class="icon-sm"></i> 567 views</span>
                            <span class="thread-meta-item"><i data-lucide="clock" class="icon-sm"></i> 5 days ago</span>
                        </div>
                        <div class="thread-tags">
                            <span class="badge badge-secondary">exam</span>
                            <span class="badge badge-secondary">help</span>
                            <span class="badge badge-secondary">midterm</span>
                        </div>
                    </div>
                </a>
            </div>
        </section>

        <!-- Sidebar -->
        <aside>
            <div class="sidebar-section">
                <h2><i data-lucide="trending-up" class="icon-md"></i> Trending</h2>
                <div class="stack-sm">
                    <a href="#" class="trending-item">
                        <span class="trending-number">1</span>
                        <div>
                            <p class="trending-title line-clamp-2">Study Group for DSA Final</p>
                            <p class="trending-upvotes">56 upvotes</p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="sidebar-section">
                <h2><i data-lucide="message-square" class="icon-md"></i> Active Subjects</h2>
                <div class="stack-sm">
                    <a href="#" class="active-subject-item">
                        <div>
                            <p class="active-subject-name">Web Programming</p>
                            <p class="active-subject-threads">312 threads</p>
                        </div>
                        <span class="badge badge-outline">S4</span>
                    </a>
                </div>
            </div>

            <div class="sidebar-section">
                <h2>Popular Tags</h2>
                <div class="tag-cloud">
                    <a href="{{ route('subjects.index') }}" class="badge badge-secondary">exam</a>
                    <a href="{{ route('subjects.index') }}" class="badge badge-secondary">help</a>
                    <a href="{{ route('subjects.index') }}" class="badge badge-secondary">lab</a>
                    <a href="{{ route('subjects.index') }}" class="badge badge-secondary">project</a>
                </div>
            </div>
        </aside>
    </div>

@endsection
