@extends('layouts.main')

@section('page.title', $post->title)

@section('main.content')
    <div class="post-header mb-4">
        <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
            <a href="{{ route('admin.posts') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i>
                {{ __('Back to All Posts') }}
            </a>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-pencil me-1"></i>
                    {{ __('Edit') }}
                </a>
                <form action="{{ route('admin.posts.delete', $post) }}" method="post"
                      onsubmit="return confirm('{{ __('Delete this post?') }}')">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        <i class="bi bi-trash me-1"></i>
                        {{ __('Delete') }}
                    </button>
                </form>
            </div>
        </div>

        <h1 class="post-title">{{ $post->title }}</h1>

        <div class="post-meta">
            <div class="d-flex flex-wrap align-items-center gap-3">
                <div class="meta-item">
                    <i class="bi bi-person-circle me-1"></i>
                    <span>{{ $post->user->name ?? '—' }}</span>
                </div>
                @if($post->published && $post->published_at)
                    <div class="meta-item">
                        <i class="bi bi-calendar-check me-1"></i>
                        <span>{{ $post->published_at->format('d.m.Y') }}</span>
                    </div>
                @else
                    <div class="meta-item">
                        <i class="bi bi-calendar-x me-1"></i>
                        <span>{{ __('Not published') }}</span>
                    </div>
                @endif
                <div class="meta-item">
                    <i class="bi bi-clock me-1"></i>
                    <span>{{ __('Updated') }}: {{ $post->updated_at->format('d.m.Y H:i') }}</span>
                </div>
            </div>
        </div>
    </div>

    <article class="post-content">
        {!! $post->content !!}
    </article>
@endsection
