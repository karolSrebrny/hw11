@extends('layout')

@section('content')
    <a href="/category/create" type="button" class="btn btn-primary">Add category</a>


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
        @forelse($categories as $category)
            <tr>
                <th scope="row">{{ $category->id }}</th>
                <td>{{ $category->title }}</td>
                <td>{{ $category->slug }}</td>
                <td>{{ $category->created_at }}</td>
                <td>{{ $category->updated_at }}</td>
                <td>
                    <a href="/category/{{ $category->id }}/edit" type="button" class="btn btn-primary">Edit</a>
                    <a href="/category/{{ $category->id }}/destroy" type="button" class="btn btn-primary">Delete</a>
                </td>
            </tr>

        @empty
            <tr><td colspan="6">No categories</td></tr>
        @endforelse
        </tbody>
    </table>
    @if($categories->currentPage()!==1)
        <a href="/categories/{{$categories->previousPageUrl()}}">Prev</a>
    @endif

    @foreach($categories -> getUrlRange($categories->currentPage(),$categories->currentPage() + 2) as $num => $link)
        <a href="/categories/{{$link}}">{{$num}}</a>
    @endforeach
    @if ($categories->currentPage()!==$categories->lastPage())
        <a href="/categories/{{$categories->nextPageUrl()}}">Next</a>
    @endif
@endSection