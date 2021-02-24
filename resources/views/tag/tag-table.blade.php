@extends('layout')

@section('content')
    <a href="/tag/create" type="button" class="btn btn-primary">Add tag</a>
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
        @forelse($tags as $tag)
            <tr>
                <th scope="row">{{ $tag->id }}</th>
                <td>{{ $tag->title }}</td>
                <td>{{ $tag->slug }}</td>
                <td>{{ $tag->created_at }}</td>
                <td>{{ $tag->updated_at }}</td>
                <td>
                    <a href="/tag/{{ $tag->id }}/edit" type="button" class="btn btn-primary">Edit</a>
                    <a href="/tag/{{ $tag->id }}/destroy" type="button" class="btn btn-primary">Delete</a>
                </td>
            </tr>
        @empty
            <tr><td colspan="6">No tags</td></tr>
        @endforelse
        </tbody>
    </table>
    @if($tags->currentPage()!==1)
        <a href="/tags/{{$tags->previousPageUrl()}}">Prev</a>
    @endif

    @foreach($tags -> getUrlRange($tags->currentPage(),$tags->currentPage() + 2) as $num => $link)
        <a href="/tags/{{$link}}">{{$num}}</a>
    @endforeach
    @if ($tags->currentPage()!==$tags->lastPage())
        <a href="/tags/{{$tags->nextPageUrl()}}">Next</a>
    @endif
@endSection