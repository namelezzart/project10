<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use function Laravel\Prompts\search;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $category_id = $request->input('category_id');

        // dd($search, $category_id);

        $post = (object) [
            'id' => 12,
            'title' => 'Lorem ipsum dolor sit amet.',
            'content' => 'Lorem ipsum <strong>dolor</strong> sit amet consectetur, adipisicing elit. Quia, voluptatem.',
            'category_id' => 1,
        ];

        $posts = array_fill(0, 10, $post);

        $posts = array_filter($posts, function($post) use($search, $category_id) {
             if($search && ! str_contains(strtolower($post->title), strtolower($search)))  {
                return false;
             }

             if($category_id && $post->category_id != $category_id)  {
                return false;
             }
        
        return true;
        });

        $categories = [
            null => __('All categories'),
            1 => __('First category'),
            2 => __('Second category')
        ];

        return view('blog.index', compact('posts', 'categories'));
    }

    public function show($post)
    { 
        $post = (object) [
            'id' => '1',
            'title' => 'Lorem ipsum dolor sit amet.',
            'content' => 'Lorem ipsum <strong>dolor</strong> sit amet consectetur, adipisicing elit. Quia, voluptatem.',
        ];
        return view('blog.show', compact('post'));
    }

    public function like($post)
    {
        return 'Лайк + 1';
    }
}
