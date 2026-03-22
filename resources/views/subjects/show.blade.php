@extends('layouts.app')

@section('title', $subject->name)

@section('content')

    <style>
        /* ── Subject Hero ───────────────────────────────────────────── */
        .subject-hero {
            background: linear-gradient(135deg, var(--primary, #4f46e5) 0%, color-mix(in srgb, var(--primary, #4f46e5) 70%, #7c3aed) 100%);
            border-radius: 1rem;
            padding: 2.5rem 2rem;
            margin-bottom: 2rem;
            color: #fff;
            position: relative;
            overflow: hidden;
        }
        .subject-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at 80% 50%, rgba(255,255,255,.08) 0%, transparent 65%);
            pointer-events: none;
        }
        .subject-hero-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
        }
        .subject-hero h1 {
            font-size: clamp(1.5rem, 4vw, 2.25rem);
            font-weight: 800;
            letter-spacing: -0.02em;
            margin: 0.5rem 0 0.75rem;
            color: #fff;
        }
        .subject-hero p {
            color: rgba(255,255,255,.75);
            margin: 0;
            max-width: 55ch;
            font-size: 0.9375rem;
        }
        .subject-hero .badge-semester {
            display: inline-flex;
            align-items: center;
            background: rgba(255,255,255,.18);
            color: #fff;
            border-radius: 2rem;
            padding: 0.25rem 0.875rem;
            font-size: 0.8125rem;
            font-weight: 600;
            letter-spacing: .01em;
            border: 1px solid rgba(255,255,255,.25);
            backdrop-filter: blur(4px);
        }
        .subject-hero .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: rgba(255,255,255,.15);
            color: #fff;
            border: 1px solid rgba(255,255,255,.25);
            border-radius: 0.5rem;
            padding: 0.4rem 0.875rem;
            font-size: 0.8125rem;
            font-weight: 500;
            text-decoration: none;
            transition: background .15s;
            flex-shrink: 0;
            backdrop-filter: blur(4px);
        }
        .subject-hero .btn-back:hover { background: rgba(255,255,255,.25); }

        /* ── Toolbar (tag filters + new thread) ────────────────────── */
        .threads-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 1rem;
        }
        .threads-toolbar h2 {
            font-size: 1.125rem;
            font-weight: 700;
            margin: 0;
        }
        .tag-filters {
            display: flex;
            flex-wrap: wrap;
            gap: 0.375rem;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        .tag-filters .tag-label {
            font-size: 0.8125rem;
            color: var(--muted-fg, #6b7280);
            margin-right: 0.25rem;
        }
        .tag-pill {
            display: inline-flex;
            align-items: center;
            border-radius: 2rem;
            padding: 0.25rem 0.75rem;
            font-size: 0.8125rem;
            font-weight: 500;
            text-decoration: none;
            border: 1.5px solid transparent;
            transition: all .15s;
            cursor: pointer;
        }
        .tag-pill-inactive {
            background: var(--muted, #f3f4f6);
            color: var(--muted-fg, #374151);
            border-color: var(--border, #e5e7eb);
        }
        .tag-pill-inactive:hover { border-color: var(--primary, #4f46e5); color: var(--primary, #4f46e5); }
        .tag-pill-active {
            background: var(--primary, #4f46e5);
            color: #fff;
            border-color: var(--primary, #4f46e5);
        }

        /* ── Thread cards ───────────────────────────────────────────── */
        .thread-list { display: flex; flex-direction: column; gap: 0.75rem; }

        .thread-item {
            background: var(--card, #fff);
            border: 1.5px solid var(--border, #e5e7eb);
            border-radius: 0.875rem;
            padding: 1.25rem 1.25rem 1rem;
            transition: border-color .15s, box-shadow .15s;
            display: grid;
            grid-template-rows: auto 1fr auto;
            gap: 0.5rem;
        }
        .thread-item:hover {
            border-color: var(--primary, #4f46e5);
            box-shadow: 0 2px 12px rgba(79,70,229,.08);
        }

        /* row 1: author + time */
        .thread-item-meta {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8125rem;
            color: var(--muted-fg, #6b7280);
        }
        .thread-item-meta .avatar {
            width: 1.625rem;
            height: 1.625rem;
            font-size: 0.625rem;
            flex-shrink: 0;
        }
        .thread-item-meta .sep {
            width: 3px;
            height: 3px;
            border-radius: 50%;
            background: var(--muted-fg, #9ca3af);
            display: inline-block;
        }

        /* row 2: title + excerpt */
        .thread-item-title {
            font-size: 1rem;
            font-weight: 700;
            line-height: 1.35;
            margin: 0 0 0.25rem;
        }
        .thread-item-title a {
            text-decoration: none;
            color: inherit;
        }
        .thread-item-title a:hover { color: var(--primary, #4f46e5); }

        .thread-item-excerpt {
            font-size: 0.875rem;
            color: var(--muted-fg, #4b5563);
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin: 0;
        }

        /* row 3: tags + actions */
        .thread-item-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            flex-wrap: wrap;
            padding-top: 0.75rem;
            border-top: 1px solid var(--border, #e5e7eb);
            margin-top: 0.25rem;
        }
        .thread-item-tags { display: flex; gap: 0.375rem; flex-wrap: wrap; }
        .thread-item-actions { display: flex; gap: 0.5rem; flex-wrap: wrap; }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 3rem 1.5rem;
            color: var(--muted-fg, #6b7280);
        }
        .empty-state h3 { font-size: 1.125rem; margin-bottom: 0.5rem; }
        .empty-state p { font-size: 0.9rem; }
    </style>

    <section class="section">

        {{-- ── Subject Hero ── --}}
        <div class="subject-hero">
            <div class="subject-hero-top">
                <span class="badge-semester">{{ $subject->semester->name }}</span>
                <a href="{{ route('subjects.index') }}" class="btn-back">
                    <i data-lucide="arrow-left" style="width:14px;height:14px;"></i>
                    All Subjects
                </a>
            </div>
            <h1>{{ $subject->name }}</h1>
            <p>Browse discussions, experiences, and shared resources for this subject.</p>
        </div>

        {{-- ── Toolbar ── --}}
        <div class="threads-toolbar">
            <h2>Threads</h2>
            @auth
                <a href="{{ route('threads.create', ['subject_id' => $subject->id]) }}" class="btn btn-primary btn-sm">
                    <i data-lucide="plus" class="icon-sm"></i>
                    New Thread
                </a>
            @endauth
        </div>

        {{-- ── Tag Filters ── --}}
        <div class="tag-filters">
            <span class="tag-label">Filter:</span>
            <a href="{{ route('subjects.show', $subject->id) }}"
               class="tag-pill {{ !$selectedTag ? 'tag-pill-active' : 'tag-pill-inactive' }}">
                All
            </a>
            @foreach($tags as $tag)
                <a href="{{ route('subjects.show', $subject->id) }}?tag={{ $tag->name }}"
                   class="tag-pill {{ $selectedTag === $tag->name ? 'tag-pill-active' : 'tag-pill-inactive' }}">
                    {{ $tag->name }}
                </a>
            @endforeach
        </div>

        {{-- ── Thread List ── --}}
        @if($threads->isEmpty())
            <div class="card empty-state">
                <i data-lucide="message-circle" style="width:2rem;height:2rem;margin-bottom:.75rem;opacity:.35;"></i>
                <h3>No threads yet</h3>
                <p>
                    {{ $selectedTag ? 'No threads tagged "' . $selectedTag . '".' : 'This subject has no discussions yet. Be the first!' }}
                </p>
            </div>
        @else
            <div class="thread-list">
                @foreach($threads as $thread)
                    @auth
                        @php
                            $isLiked     = $thread->likes->contains('user_id', auth()->id());
                            $isDisliked  = method_exists($thread, 'dislikes')
                                ? $thread->dislikes->contains('user_id', auth()->id())
                                : false;
                        @endphp
                    @endauth

                    <div class="thread-item">

                        {{-- Meta: author + time --}}
                        <div class="thread-item-meta">
                            @if($thread->is_anonymous)
                                <span class="avatar avatar-sm avatar-primary">AN</span>
                                <span>Anonymous</span>
                            @else
                                <span class="avatar avatar-sm avatar-primary">
                                {{ strtoupper(substr($thread->user->name, 0, 2)) }}
                            </span>
                                <span>{{ $thread->user->name }}</span>
                            @endif
                            <span class="sep"></span>
                            <i data-lucide="clock" style="width:12px;height:12px;flex-shrink:0;"></i>
                            <span>{{ $thread->created_at->diffForHumans() }}</span>
                        </div>

                        {{-- Title + excerpt --}}
                        <div>
                            <h3 class="thread-item-title">
                                <a href="{{ route('threads.show', $thread->id) }}">{{ $thread->title }}</a>
                            </h3>
                            <p class="thread-item-excerpt">{{ $thread->content }}</p>
                        </div>

                        {{-- Footer: tags left, actions right --}}
                        <div class="thread-item-footer">
                            <div class="thread-item-tags">
                                @foreach($thread->tags as $tag)
                                    <span class="badge badge-primary" style="font-size:.75rem;">{{ $tag->name }}</span>
                                @endforeach
                            </div>

                            <div class="thread-item-actions">
                                @auth
                                    {{-- Like --}}
                                    <button
                                        type="button"
                                        class="btn btn-outline btn-sm reaction-btn"
                                        data-url="/threads/{{ $thread->id }}/like"
                                        data-kind="like"
                                        data-group="subject-thread-{{ $thread->id }}"
                                    >
                                        <i data-lucide="heart" class="icon-sm reaction-icon reaction-like-icon"
                                           style="{{ $isLiked ? 'fill:currentColor;color:#e11d48;' : '' }}"></i>
                                        <span class="reaction-count reaction-like-count">{{ $thread->likes->count() }}</span>
                                    </button>

                                    {{-- Dislike --}}
                                    <button
                                        type="button"
                                        class="btn btn-outline btn-sm reaction-btn"
                                        data-url="/threads/{{ $thread->id }}/dislike"
                                        data-kind="dislike"
                                        data-group="subject-thread-{{ $thread->id }}"
                                    >
                                        <i data-lucide="thumbs-down" class="icon-sm reaction-icon reaction-dislike-icon"
                                           style="{{ $isDisliked ? 'color:#2563eb;' : '' }}"></i>
                                        <span class="reaction-count reaction-dislike-count">{{ method_exists($thread, 'dislikes') ? $thread->dislikes->count() : 0 }}</span>
                                    </button>
                                @endauth

                                {{-- Comments --}}
                                <a href="{{ route('threads.show', $thread->id) }}" class="btn btn-outline btn-sm">
                                    <i data-lucide="message-circle" class="icon-sm"></i>
                                    {{ $thread->comments->count() }}
                                </a>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif

    </section>

    @auth
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                function setLikeIconState(icon, active) {
                    if (!icon) return;
                    icon.style.color = active ? '#e11d48' : '';
                    icon.style.fill  = active ? 'currentColor' : '';
                }

                function setDislikeIconState(icon, active) {
                    if (!icon) return;
                    icon.style.color = active ? '#2563eb' : '';
                    icon.style.fill  = '';
                }

                async function handleReaction(button) {
                    const url   = button.dataset.url;
                    const kind  = button.dataset.kind;
                    const group = button.dataset.group;

                    const groupButtons = document.querySelectorAll(`.reaction-btn[data-group="${group}"]`);
                    const likeBtn      = Array.from(groupButtons).find(b => b.dataset.kind === 'like');
                    const dislikeBtn   = Array.from(groupButtons).find(b => b.dataset.kind === 'dislike');

                    const likeIcon     = likeBtn?.querySelector('.reaction-like-icon');
                    const dislikeIcon  = dislikeBtn?.querySelector('.reaction-dislike-icon');
                    const likeCount    = likeBtn?.querySelector('.reaction-like-count');
                    const dislikeCount = dislikeBtn?.querySelector('.reaction-dislike-count');

                    try {
                        const response = await fetch(url, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN':     csrfToken,
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept':           'application/json',
                            },
                        });

                        if (!response.ok) throw new Error('Reaction request failed.');

                        const data = await response.json();

                        if (typeof data.likes_count    !== 'undefined' && likeCount)    likeCount.textContent    = data.likes_count;
                        if (typeof data.dislikes_count !== 'undefined' && dislikeCount) dislikeCount.textContent = data.dislikes_count;

                        if (kind === 'like') {
                            setLikeIconState(likeIcon, !!data.liked);
                            if (data.liked) setDislikeIconState(dislikeIcon, false);
                        }
                        if (kind === 'dislike') {
                            setDislikeIconState(dislikeIcon, !!data.disliked);
                            if (data.disliked) setLikeIconState(likeIcon, false);
                        }
                    } catch (err) {
                        console.error(err);
                    }
                }

                document.querySelectorAll('.reaction-btn').forEach(btn => {
                    btn.addEventListener('click', function () { handleReaction(this); });
                });
            });
        </script>
    @endauth

@endsection
