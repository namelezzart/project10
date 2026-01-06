<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;

use function Laravel\Prompts\alert;

class PostController extends Controller
{
    public function index()
    {
        $post = (object) [
            'id' => '1',
            'title' => 'Lorem ipsum dolor sit amet.',
            'content' => 'Lorem ipsum <strong>dolor</strong> sit amet consectetur, adipisicing elit. Quia, voluptatem.',
        ];

        $posts = array_fill(0, 10, $post);

        return view('user.posts.index', compact('posts'));
    }
     public function create()
    {
        return view('user.posts.create');
    }
    public function store(Request $request)
    { 
        $validated = validate($request->all(), [
            'title' => ['required','string', 'max:100'],
            'content' => ['required','string', 'max:10000'],
            'published_at' => ['nullable','string', 'date'],
            'published' => ['nullable', 'boolean'],
        ]);

        $post = Post::query()->firstOrCreate([
            'user_id' => User::query()->value('id'),
            'title' => $validated['title']
        ], [
            'content' => $validated['content'],
            'published_at' => new Carbon($validated['published_at'] ?? null),
            'published' => $validated['published'] ?? false,
        ]);

        dd($post->toArray());

        return redirect()->route('user.posts.show',  123); 
    }
    public function show($post)
    {
        $post = (object) [
            'id' => '1',
            'title' => 'Lorem ipsum dolor sit amet.',
            'content' => 'Lorem ipsum <strong>dolor</strong> sit amet consectetur, adipisicing elit. Quia, voluptatem.',
        ];

        return view('user.posts.show', compact('post')); 
    }
    public function edit($post)
    {
        $post = (object) [
            'id' => '1',
            'title' => 'Lorem ipsum dolor sit amet.',
            'content' => 'Lorem ipsum <strong>dolor</strong> sit amet consectetur, adipisicing elit. Quia, voluptatem.',
        ];

        return view('user.posts.edit', compact('post'));
    }
    public function update(Request $request, $post)
    {
        $validated = validate($request->all(), [
            'title' => ['required','string', 'max:100'],
            'content' => ['required','string', 'max:10000'],
        ]);

        dd($validated);

        return redirect()->back();
    }
    public function delete($post)
    {
        return redirect()->route('user.posts');
    }
    public function like() 
    {
         return 'Страница лайка поста';
    }   
}
