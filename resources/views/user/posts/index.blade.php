@extends('layouts.main')

@section('page.title', 'My posts')

@push('css')
    @include('components.post.card-styles')
@endpush

@section('main.content')
    <x-title>
        {{ __('My posts')}}

        <x-slot name="right">
            <x-button_link href="{{ route('user.posts.create') }}">
                {{ __('Create') }}
            </x-button_link>
        </x-slot>
    </x-title>

    @if (empty($posts))
        <div class="text-center py-5">
            <p class="text-muted">{{ __('Empty post') }}</p>
        </div>
    @else
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-4">
            @foreach ($posts as $post)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title mb-3">
                                <a href="{{ route('user.posts.show', $post->id) }}" class="text-decoration-none stretched-link">
                                    {{ Str::limit($post->title, 60) }}
                                </a>
                            </h5>
                            
                            <div class="card-text mb-3 flex-grow-1">
                                <p class="text-muted small mb-0">
                                    {{ Str::limit(strip_tags($post->content), 120) }}
                                </p>
                            </div>
                            
                            <div class="card-footer bg-transparent border-0 p-0 mt-auto">
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">
                                        @if($post->published && $post->published_at)
                                            <i class="bi bi-calendar-check"></i>
                                            {{ $post->published_at->format('d.m.Y') }}
                                        @else
                                            <span class="badge bg-secondary">{{ __('Not published') }}</span>
                                        @endif
                                    </small>
                                    
                                    @if($post->published)
                                        <span class="badge bg-success">Published</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    @endif
@endsection