<?php

namespace App\Controller;

use App\Model\Category;
use App\Model\Post;
use App\Model\Tag;
use Illuminate\Http\RedirectResponse;

class PostController
{
    public function index()
    {
//                $posts = \App\Model\Post::withTrashed()->get();
                $posts = \App\Model\Post::paginate(3);

        //        $posts = \App\Model\Post::onlyTrashed()->get();

        //        $posts = \App\Model\Post::get();

        return view('post/post-table', compact('posts'));
    }

    public function create()
    {
        $post = new Post();

        return view('post/post-form', compact('post'));
    }

    public function store()
    {
        $data = request()->all();

        $validator = validator()->make($data, [
            'title' => ['required', 'min:5', 'unique:posts,title'],
            'slug' => ['required']
        ]);
        $error = $validator ->errors();
        if (count($error) >0){
            $_SESSION['data'] = $data;
            $_SESSION['errors'] = $error ->toArray();

            return new RedirectResponse($_SERVER['HTTP_REFERER']);}

        $post = new Post();
        $post->title = $data['title'];
        $post->slug = $data['slug'];
        $post->save();

        $_SESSION['message'] = [
            'status' => 'success',
            'text' => "Post \" {$data['title']}\" succesfully saved.",
        ];

        return new RedirectResponse('/posts');
    }

    public function edit($id)
    {
        $post = \App\Model\Post::find($id);

        return view('post/post-form', compact('post'));
    }

    public function update($id)
    {
        $post = \App\Model\Post::find($id);

        $data = request()->all();

        $validator = validator()->make($data, [
            'title' => ['required', 'min:5', 'unique:posts,title,' . $id],
            'slug' => ['required','unique:posts,slug,' .$id],
        ]);

        $error = $validator ->errors();
        if (count($error) >0){
            $_SESSION['data'] = $data;
            $_SESSION['errors'] = $error ->toArray();

            return new RedirectResponse($_SERVER['HTTP_REFERER']);}

        $post->title = $data['title'];
        $post->slug = $data['slug'];
        $post->save();
        $_SESSION['message'] = [
            'status' => 'success',
            'text' => "Post \" {$data['title']}\" succesfully updated.",
        ];


        return new RedirectResponse('/posts');
    }

    public function destroy($id)
    {
        $post = \App\Model\Post::find($id);
        $post->delete();

        return new RedirectResponse('/posts');
    }
}
