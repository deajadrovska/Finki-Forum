@extends('layouts.app')

@section('title', 'Subjects')

@section('content')

    <section class="section">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;">
            <h1>Subjects</h1>
        </div>

        <div class="grid-4">
            @foreach($subjects as $subject)
                <a href="{{ route('subjects.show', $subject->id) }}"
                   class="card category-card"
                   style="padding:1.6rem;display:flex;flex-direction:column;gap:0.8rem;">

                    <div style="display:flex;align-items:center;gap:0.9rem;">
                        <div class="category-icon">
                            <i data-lucide="book-open" class="icon-md"></i>
                        </div>

                        <h3 style="margin:0;font-size:1.2rem;font-weight:600;color:#1e293b;">
                            {{ $subject->name }}
                        </h3>
                    </div>

                    <div style="font-size:0.9rem;color:#334155;font-weight:500;">
                        {{ $subject->semester->name }}
                    </div>

                    @if($subject->majors->isNotEmpty())
                        <div style="display:flex;flex-wrap:wrap;gap:8px;margin-top:4px;">
                            @foreach($subject->majors as $major)
                                <span
                                    style="
                                    font-size:0.75rem;
                                    padding:4px 10px;
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

                    <div style="
                            margin-top:auto;
                            padding-top:0.6rem;
                            border-top:1px solid #e5e7eb;
                            display:flex;
                            justify-content:space-between;
                            font-size:0.9rem;
                            color:#334155;
                            font-weight:500;
                        ">
                            <span style="color:#1e293b;font-weight:600;">
                                {{ $subject->threads_count ?? 0 }}
                                <span>threads</span>
                            </span>


                    </div>

                </a>
            @endforeach
        </div>
    </section>

@endsection
