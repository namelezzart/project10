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

        <div class="d-flex align-items-center gap-2 mt-3">
            @auth
                @php $liked = $post->isLikedBy(auth()->user()); @endphp
                <form action="{{ route('blog.like', $post) }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-sm {{ $liked ? 'btn-danger' : 'btn-outline-danger' }}">
                        <i class="bi {{ $liked ? 'bi-heart-fill' : 'bi-heart' }} me-1"></i>
                        {{ $liked ? __('Liked') : __('Like') }}
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-sm btn-outline-danger">
                    <i class="bi bi-heart me-1"></i>
                    {{ __('Log in to like') }}
                </a>
            @endauth
            <span class="text-muted small">
                {{ $post->likedByUsers()->count() }} {{ __('likes') }}
            </span>
        </div>
    </div>

    <!-- Content Section -->
    <article class="post-content">
        {!! $post->content !!}
    </article>
@endsection