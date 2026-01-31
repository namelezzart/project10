@extends('layouts.main')

@section('page.title', 'Change post')

@section('main.content')
    <!-- Header Section -->
    <div class="mb-4">
        <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
            <a href="{{ route('user.posts.show', $post->id) }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i>
                {{ __('Back to Post') }}
            </a>
        </div>
        
        <h1 class="h2 mb-4">
            <i class="bi bi-pencil-square me-2 text-primary"></i>
            {{ __('Change post') }}
        </h1>
    </div>

    <x-post.form action="{{ route('user.posts.update', $post->id) }}" method="put" :post="$post">
        <div class="mt-4 pt-4 mb-5 border-top">
            <x-button type="submit">
                {{ __('Change') }}
            </x-button>
        </div>
    </x-post.form>
@endsection
