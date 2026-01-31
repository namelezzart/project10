<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('user_id', auth()->id())
                    ->latest()
                    ->paginate(10);
        return view('user.posts.index', compact('posts'));
    }
    
    public function create()
    {
        return view('user.posts.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'published' => 'boolean',
        ]);
        
        $validated['user_id'] = auth()->id();
        
        // Устанавливаем дату публикации
        if (isset($validated['published']) && $validated['published']) {
            $validated['published_at'] = now();
        } else {
            $validated['published'] = false;
            $validated['published_at'] = null;
        }
        
        Post::create($validated);
        
        return redirect()->route('user.posts')
                        ->with('success', 'Пост успешно создан');
    }
    
    public function show(Post $post)
    {
        return view('user.posts.show', compact('post')); 
    }
    
    public function edit(Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('user.posts.edit', compact('post'));
    }
    
    public function update(Request $request, Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'published' => 'boolean',
        ]);
        
        // Обновляем дату публикации
        if (isset($validated['published']) && $validated['published']) {
            // Если пост ранее не был опубликован, устанавливаем дату
            if (!$post->published || !$post->published_at) {
                $validated['published_at'] = now();
            }
        } else {
            $validated['published'] = false;
            $validated['published_at'] = null;
        }
        
        $post->update($validated);
        
        return redirect()->route('user.posts')
                        ->with('success', 'Пост успешно обновлён');
    }
    
    public function delete(Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $post->delete();
        
        return redirect()->route('user.posts')
                        ->with('success', 'Пост успешно удалён');
    }
    
    public function like(Request $request, Post $post)
    {
        // Здесь реализуйте логику лайков
        // Например, через отдельную таблицу likes
        
        return back()->with('success', 'Лайк добавлен');
    }
}