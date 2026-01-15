@extends('layouts.main')

@section('page.title', 'My posts')

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
        {{ __('Empty post') }}
    @else
        @foreach ($posts as $post)
            <div class="mb-3">
                <h2 class="h6">
                    <a href="{{ route('user.posts.show', $post->id) }}">
                        {{ $post->title }}
                    </a>
                </h2>

                <div class="small text-muted">
                    {{ $post->published_at->format('d.m.Y H:i:s') }}
                </div>
            </div>
        @endforeach
        
        {{ $posts->links() }}
    @endif
@endsection