@extends('layouts.main')

@section('page.title', 'All posts')

@push('css')
    @include('components.post.card-styles')
@endpush

@section('main.content')
    <x-title>
        {{ __('All posts') }}

        <x-slot name="right">
            <x-button_link href="{{ route('admin.posts.create') }}">
                {{ __('Create') }}
            </x-button_link>
        </x-slot>
    </x-title>

    @if (empty($posts))
        <div class="text-center py-5">
            <p class="text-muted">{{ __('Empty post') }}</p>
        </div>
    @else
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Author') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th class="text-end">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>
                                <a href="{{ route('admin.posts.show', $post->id) }}" class="text-decoration-none">
                                    {{ Str::limit($post->title, 60) }}
                                </a>
                            </td>
                            <td>{{ $post->user->name ?? '—' }}</td>
                            <td>
                                @if($post->published && $post->published_at)
                                    <span class="badge bg-success">{{ __('Published') }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ __('Not published') }}</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.posts.delete', $post) }}" method="post" class="d-inline"
                                      onsubmit="return confirm('{{ __('Delete this post?') }}')">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    @endif
@endsection
