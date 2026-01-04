<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index()
    {
        return 'Страница список постов';
    }
     public function create()
    {
        return 'Страница создание поста';
    }
    public function store()
    {
        return 'Страница создание поста';
    }
    public function show($post)
    {
        return "Страница просмотра поста {$post}";
    }
    public function edit($post)
    {
        return "Страница редактирования поста {$post}";
    }
    public function update()
    {
        return 'Страница обновления поста';
    }
    public function delete()
    {
        return 'Страница удаления поста';
    }
    public function like()
    {
        return 'Страница лайка поста';
    }   
}
