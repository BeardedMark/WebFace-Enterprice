<?php

namespace App\Http\Controllers\Etp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumbs = [['title' => 'Статьи']];
        $posts = $this->etp->GetPostsList();

        return view('etp.posts.index', compact('breadcrumbs', 'posts'));
    }

    public function create() {}

    public function store(Request $request) {}

    public function show(string $id, Request $request)
    {
        $post = $this->etp->GetPostCard($id);
        $breadcrumbs = [
            ['title' => 'Статьи', 'url' => route('posts.index')],
            ['title' => $post['name']]
        ];

        return view('etp.posts.show', compact('post', 'breadcrumbs'));
    }

    public function edit(string $id) {}

    public function update(Request $request, string $id) {}

    public function destroy(string $id) {}
}
