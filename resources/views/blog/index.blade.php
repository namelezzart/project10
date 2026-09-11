@extends('layouts.main')

@section('page.title', 'Blog')

@push('css')
    @include('components.post.card-styles')
    @include('components.post.stagger-styles')
@endpush

@push('js')
    @include('components.post.stagger-script')
@endpush

@section('main.content')
    <x-title>
        {{ __('Blog list')}}
    </x-title>

    @if($latestPosts->isNotEmpty())
        <section class="post-stagger-section">
            <h2 class="h5 mb-3">{{ __('Latest posts') }}</h2>
            <x-post.stagger :posts="$latestPosts" />
        </section>

        <hr class="post-section-divider">
    @endif

    <section>
        <h2 class="h5 mb-3">{{ __('All posts') }}</h2>

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
    </section>
@endsection