@extends('layout')

@section('content')
    <form method="post">
        @if(isset($_SESSION['errors']['title']))
            @foreach($_SESSION['errors']['title'] as $error)
                <div class="alert alert-danger" role="alert">
                    {{  $error    }}
                </div>

            @endforeach
        @endif
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $_SESSION['data']['title'] ?? $tag -> title }}">
        </div>
            @if (isset($_SESSION['errors']['slug']))
                @foreach($_SESSION['errors']['slug'] as $error)
                    <div class="alert alert-danger" role="alert">
                        {{  $error    }}
                    </div>
                @endforeach
            @endif
        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control" id="slug" name="slug" value="{{ $_SESSION['data']['title'] ?? $tag -> title }}">
        </div>
        <div class="mb-3">
            <input type="submit" class="btn btn-primary mb-3" value="Save" />
        </div>
    </form>
    @php
        unset($_SESSION['errors']);
        unset($_SESSION['data']);
    @endphp
@endSection