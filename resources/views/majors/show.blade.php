@extends('layouts.app')

@section('title', $major->name)

@section('content')

    <section class="section">
        <h1>{{ $major->name }}</h1>
        <p style="color: var(--muted); margin-bottom:2rem;">
            {{ $major->code }}
        </p>

        <div class="grid-2">

            {{-- SUBJECTS --}}
            <div>
                <h2 style="margin-bottom:1rem;">Subjects</h2>

                @if($major->subjects->isEmpty())
                    <div class="card" style="padding:1rem;">
                        No subjects linked to this major yet.
                    </div>
                @else

                    <div class="space-y">
                        @foreach($major->subjects as $subject)

                            <a href="{{ route('subjects.show', $subject->id) }}" class="card" style="padding:1rem; display:block;">
                                <h3>{{ $subject->name }}</h3>

                                <p style="color:var(--muted);">
                                    {{ $subject->semester->name }}
                                </p>
                            </a>

                        @endforeach
                    </div>

                @endif
            </div>


            {{-- THREADS --}}
            <div>
                <h2 style="margin-bottom:1rem;">Recent Threads</h2>

                @if($threads->isEmpty())

                    <div class="card" style="padding:1rem;">
                        No discussions yet.
                    </div>

                @else

                    <div class="space-y">

                        @foreach($threads as $thread)

                            <a href="{{ route('threads.show', $thread->id) }}" class="card" style="padding:1rem; display:block;">

                                <h3 style="margin-bottom:0.5rem;">
                                    {{ $thread->title }}
                                </h3>

                                <p style="color:var(--muted); font-size:0.9rem;">
                                    {{ $thread->subject->name }}
                                </p>

                                <div style="display:flex; gap:1rem; margin-top:0.5rem; color:var(--muted); font-size:0.85rem;">

                                <span>
                                    ❤️ {{ $thread->likes->count() }}
                                </span>

                                    <span>
                                    💬 {{ $thread->replies->count() }}
                                </span>

                                </div>

                            </a>

                        @endforeach

                    </div>

                @endif
            </div>

        </div>

    </section>

@endsection
