<div class="card h-100 shadow-sm">
    <div class="card-body d-flex flex-column">
        <h5 class="card-title mb-3">
            <a href="{{ route('blog.show', $post->id) }}" class="text-decoration-none stretched-link">
                {{ Str::limit($post->title, 60) }}
            </a>
        </h5>
        
        <div class="card-text mb-3 flex-grow-1">
            <p class="text-muted small mb-0">
                {{ Str::limit(strip_tags($post->content), 120) }}
            </p>
        </div>
        
        <div class="card-footer bg-transparent border-0 p-0 mt-auto">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">
                    @if($post->published_at)
                        <i class="bi bi-calendar-check"></i>
                        {{ $post->published_at->format('d.m.Y') }}
                    @endif
                </small>
                
                <div class="d-flex gap-2 align-items-center">
                    @if($post->user)
                        <small class="text-muted">
                            <i class="bi bi-person-circle"></i>
                            {{ $post->user->name }}
                        </small>
                    @endif
                    
                    @if($post->published)
                        <span class="badge bg-success">Published</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>