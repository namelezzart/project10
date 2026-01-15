@extends('layouts.main')

@section('page.title', 'Blog')

@section('main.content')
    <x-title>
        {{ __('Blog list')}}
    </x-title>

@include('blog.filter') 

    <div class="row">
        @if ($posts->isEmpty())
            {{ __('Empty post') }}
        @else
            @foreach ($posts as $post)
                <div class="col-12 col-md-4">
                    <x-post.card :post="$post"/>
                </div>
            @endforeach
            
            {{ $posts->links()}}
        @endif
    </div>
@endsection