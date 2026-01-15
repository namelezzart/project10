<x-card>
    <x-card_body>
        <h2 class="h5">
            <a href="{{ route('blog.show', $post->id)}}">
                {{ $post->title }} 
            </a>
        </h2>

        <p class="small text-muted">
            {{ $post->published_at?->diffForHumans() }}
        </p>

        {{ $post->id }}
    </x-card_body>
</x-card>