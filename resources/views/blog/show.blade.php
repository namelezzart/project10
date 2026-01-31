@extends('layouts.main')

@section('page.title', $post->title)

@section('main.content')
    <!-- Header Section -->
    <div class="post-header mb-4">
        <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
            <a href="{{ route('blog') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i>
                {{ __('Back to Blog') }}
            </a>
            @auth
                @if(Auth::id() === $post->user_id)
                    <a href="{{ route('user.posts.edit', $post) }}" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-pencil me-1"></i>
                        {{ __('Edit') }}
                    </a>
                @endif
            @endauth
        </div>
        
        <h1 class="post-title">{{ $post->title }}</h1>
        
        <div class="post-meta">
            <div class="d-flex flex-wrap align-items-center gap-3">
                <div class="meta-item">
                    <i class="bi bi-person-circle me-1"></i>
                    <span>{{ $post->user->name }}</span>
                </div>
                @if($post->published_at)
                    <div class="meta-item">
                        <i class="bi bi-calendar-check me-1"></i>
                        <span>{{ $post->published_at->format('d.m.Y') }}</span>
                    </div>
                @endif
                <div class="meta-item">
                    <i class="bi bi-clock me-1"></i>
                    <span>{{ ceil(str_word_count(strip_tags($post->content)) / 200) }} min read</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <article class="post-content">
        {!! $post->content !!}
    </article>
@endsection