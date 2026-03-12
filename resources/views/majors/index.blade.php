@extends('layouts.app')

@section('title', 'Majors')

@section('content')
    <section class="section">
        <h1 style="margin-bottom: 1.5rem;">Majors</h1>

        @if($majors->isEmpty())
            <div class="card" style="padding: 1.5rem;">
                <h3>No majors found</h3>
                <p>Add some majors from the admin panel first.</p>
            </div>
        @else
            <div class="grid-4">
                @foreach($majors as $major)
                    <a href="{{ route('majors.show', $major->id) }}" class="card category-card">
                        <div class="category-icon">
                            <i data-lucide="graduation-cap" class="icon-md"></i>
                        </div>

                        <h3>{{ $major->name }}</h3>

                        <p>{{ $major->code }}</p>

                        <div class="category-stats">
                            <span>{{ $major->subjects_count }} subjects</span>
                            <span>Study program</span>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </section>
@endsection
