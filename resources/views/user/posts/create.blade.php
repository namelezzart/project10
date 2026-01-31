@extends('layouts.main')

@section('page.title', 'Create post')

@section('main.content')
    <!-- Header Section -->
    <div class="mb-4">
        <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
            <a href="{{ route('user.posts') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i>
                {{ __('Back to My Posts') }}
            </a>
        </div>
        
        <h1 class="h2 mb-4">
            <i class="bi bi-file-earmark-plus me-2 text-primary"></i>
            {{ __('Create post') }}
        </h1>
    </div>

    <x-post.form action="{{ route('user.posts.store') }}" method="post">
        <div class="mt-4 pt-4 mb-5 border-top">
            <x-button type="submit">
                {{ __('Create') }}
            </x-button>
        </div>
    </x-post.form>
@endsection
