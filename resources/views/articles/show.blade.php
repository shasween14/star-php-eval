@extends('layout')

@section('title', $article->title)

@section('content')
    <div class="col-lg-8 mx-auto">
        <a href="{{ url('/articles') }}" class="text-decoration-none small">&larr; Back to all articles</a>

        <article class="bg-body rounded border p-4 p-md-5 mt-3">
            <span class="badge text-bg-primary mb-3">{{ $article->category->name }}</span>
            <h1 class="h2 fw-bold mb-3">{{ $article->title }}</h1>

            <div class="text-secondary small pb-3 mb-4 border-bottom">
                By <strong>{{ $article->author }}</strong>
                &middot; {{ $article->published_at?->format('d M Y') }}
            </div>

            <p class="lead text-secondary">{{ $article->summary }}</p>

            @foreach (preg_split('/\R{2,}/', $article->body) as $paragraph)
                <p>{{ $paragraph }}</p>
            @endforeach
        </article>
    </div>
@endsection
