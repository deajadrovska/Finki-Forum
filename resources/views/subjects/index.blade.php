@extends('layouts.app')

@section('title', 'Subjects')

@section('content')

    <section class="section">

        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;">
            <h1>Subjects</h1>
        </div>

        <div class="grid-4">

            @foreach($subjects as $subject)

                <a href="{{ route('subjects.show', $subject->id) }}" class="card category-card">

                    <div class="category-icon">
                        <i data-lucide="book-open" class="icon-md"></i>
                    </div>

                    <h3>{{ $subject->name }}</h3>

                    <p>
                        Semester {{ $subject->semester->name }}
                    </p>

                    <div class="category-stats">
                        <span>{{ $subject->threads_count ?? 0 }} threads</span>
                        <span>{{ $subject->posts_count ?? 0 }} posts</span>
                    </div>

                </a>

            @endforeach

        </div>

    </section>

@endsection
