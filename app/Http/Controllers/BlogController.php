<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

use function Laravel\Prompts\search;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:50'],
            'from_date' => ['nullable', 'date', 'max:50'],
            'to_date' => ['nullable', 'date', 'max:50', 'after:from_date'],
        ]);
         
        $query = Post::query()
            ->where('published', true)
            ->whereNotNull('published_at');

        if ($search = $validated['search'] ?? null) {
            $query->where('title', 'ilike', "%{$search}%");
        }
        if ($fromDate = $validated['from_date'] ?? null) {
            $query->where('published_at', '>=', new Carbon($fromDate));
        }
        if ($toDate = $validated['to_date'] ?? null) {
            $query->where('published_at', '<=', new Carbon($toDate));
        }

        $posts = $query->latest('published_at') 
            ->paginate(12);

        return view('blog.index', compact('posts'));
    }

    public function show(Request $request, Post $post)
    {   
        return view('blog.show', compact('post'));
    }

    public function like($post)
    { 
        return 'Лайк + 1';
    }
}
