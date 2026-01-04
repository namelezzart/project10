@extends('layouts.main')

@section('page.title', 'Change post')

@section('main.content')
    <x-title>
        {{ __('Change post')}} 

        <x-slot name="link">
            <a href="{{ route('user.posts.show', $post->id) }}">
                {{ __('Back') }}
            </a>
        </x-slot>
    </x-title>

    <x-post.form action="{{ route('user.posts.update', $post->id ) }}" method="put" :post="$post">
        <x-button type="submit">
            {{ __('Change' )}}
        </x-button>
    </x-post.form>
@endsection