@props(['posts'])

@php
    $posts = $posts instanceof \Illuminate\Support\Collection ? $posts : collect($posts);
    $total = $posts->count();
@endphp

@if($total > 0)
    <div class="post-stagger" data-post-stagger>
        <div class="post-stagger__track">
            @foreach($posts as $index => $post)
                @php
                    $position = $total % 2
                        ? $index - intdiv($total + 1, 2)
                        : $index - intdiv($total, 2);
                    $excerpt = Str::limit(strip_tags($post->content), 130);
                    $likes = $post->liked_by_users_count ?? $post->likedByUsers()->count();
                @endphp
                <div
                    class="post-stagger__card{{ $position === 0 ? ' is-center' : '' }}"
                    data-position="{{ $position }}"
                    data-url="{{ route('blog.show', $post->id) }}"
                    role="link"
                    tabindex="0"
                    aria-label="{{ $post->title }}"
                >
                    <span class="post-stagger__corner-line"></span>

                    <span class="post-stagger__icon">
                        <i class="bi bi-journal-richtext"></i>
                    </span>

                    <h3 class="post-stagger__title">{{ Str::limit($post->title, 70) }}</h3>
                    <p class="post-stagger__excerpt">{{ $excerpt }}</p>

                    <div class="post-stagger__meta">
                        @if($post->user)
                            <span class="post-stagger__meta-item">
                                <i class="bi bi-person-circle"></i> {{ $post->user->name }}
                            </span>
                        @endif
                        @if($post->published_at)
                            <span class="post-stagger__meta-item">
                                <i class="bi bi-calendar-check"></i> {{ $post->published_at->format('d.m.Y') }}
                            </span>
                        @endif
                        <span class="post-stagger__meta-item">
                            <i class="bi bi-heart-fill"></i> {{ $likes }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>

        @if($total > 1)
            <div class="post-stagger__controls">
                <button type="button" class="post-stagger__btn" data-stagger-prev aria-label="{{ __('Previous post') }}">
                    <i class="bi bi-chevron-left"></i>
                </button>
                <button type="button" class="post-stagger__btn" data-stagger-next aria-label="{{ __('Next post') }}">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
        @endif
    </div>
@endif
