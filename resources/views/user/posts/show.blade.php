@extends('layouts.main')

@section('page.title', 'Viewing')

@section('main.content')
    <x-title>
        {{ __('Viewing post')}}

        <x-slot name="right">
            <x-button_link href="{{ route('user.posts.edit', $post->id) }}">
                {{ __('Change') }}
            </x-button_link>
        </x-slot>
                
        <x-slot name="link">
            <a href="{{ route('user.posts') }}">
                {{ __('Back') }}
            </a>
        </x-slot>
    </x-title>

    <h2 class="h4">
        {{ $post->title }}
    </h2>

    <div class="small text-muted">
        {{ now()->format('d.m.Y H:i:s') }}
    </div>

    <div class="pt-4">
        {!! $post->content !!}
    </div>
@endsection