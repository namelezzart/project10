@extends('layouts.main')

@section('page.title', $post->title)

@section('main.content')
    <x-title>
        {{ $post->title }}

        <x-slot name="link">
            <div class="mb-2">
                <a href="{{ route('blog') }}">
                    {{ __('Back') }}
                </a>
            </div>
        </x-slot>
    </x-title> 

    {!! $post->content !!}
@endsection