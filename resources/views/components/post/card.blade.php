<x-card>
    <x-card_body>
        <h2 class="h5">
            <a href="{{ route('blog.show', $post->id)}}">
                {{ $post->title }} 
            </a>
        </h2>

        <p class="small text-muted">
            {{ now()->format('d.m.Y H:i:s') }}
        </p>
    </x-card_body>
</x-card>