@extends('layouts.main')

@section('page.title', 'Blog')

@push('css')
    @include('components.post.card-styles')
@endpush

@section('main.content')
    <x-title>
        {{ __('Blog list')}}
    </x-title>

@include('blog.filter') 

    @if ($posts->isEmpty())
        <div class="text-center py-5">
            <p class="text-muted">{{ __('Empty post') }}</p>
        </div>
    @else
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-4">
            @foreach ($posts as $post)
                <div class="col">
                    <x-post.card :post="$post"/>
                </div>
            @endforeach
        </div>
        
        <div class="d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    @endif
@endsection