@extends('layout')

@section('content')
    <a href="/post/create" type="button" class="btn btn-primary">Add post</a>

    @if (isset($_SESSION['message']))

        <div class="alert alert-{{ $_SESSION['message']['status'] }}" role="alert">
            {{   $_SESSION['message']['text']    }}
        </div>

        @unset($_SESSION['message'])
    @endif

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Slug</th>
            <th scope="col">Created At</th>
            <th scope="col">Updated At</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($posts as $post)
            <tr>
                <th scope="row">{{ $post->id }}</th>
                <td>{{ $post->title }}</td>
                <td>{{ $post->slug }}</td>
                <td>{{ $post->created_at }}</td>
                <td>{{ $post->updated_at }}</td>
                <td>
                    <a href="/post/{{ $post->id }}/edit" type="button" class="btn btn-primary">Edit</a>
                    <a href="/post/{{ $post->id }}/destroy" type="button" class="btn btn-primary">Delete</a>
                </td>
            </tr>

        @empty
            <tr><td colspan="6">No posts</td></tr>
        @endforelse
        </tbody>
    </table>
    @if($posts->currentPage()!==1)
    <a href="/posts/{{$posts->previousPageUrl()}}">Prev</a>
    @endif

    @foreach($posts -> getUrlRange($posts->currentPage(),$posts->currentPage() + 2) as $num => $link)
    <a href="/posts/{{$link}}">{{$num}}</a>
    @endforeach
    @if ($posts->currentPage()!==$posts->lastPage())
    <a href="/posts/{{$posts->nextPageUrl()}}">Next</a>
    @endif
@endSection