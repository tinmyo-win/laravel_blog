<!DOCTYPE html>
<html lang = "en" dir = "ltr">
<head>
    <meta charset="UTF-8">
    <title>Article List</title>
</head>
<body>

@extends("layouts.app")

@section("content")
    <div class= "container">

        @if(session('error') )
            <div class="alert alert-warning">
                {{ session('error') }}
            </div>
        @endif
        
        <div class= "mb-2">
            <div class= "card-body">
                <h5 class="card-title"> {{ $article->title }} </h5>
                <div class= "card-subtitle mb-2 text-muted small">
                    {{ $article->created_at->diffForHumans() }}
                    Category: <b> {{ $article->category->name }}</b>
                </div>
                <p class= "card-text"> {{ $article->body }} </p>

                @if ( isset(auth()->user()->id) and auth()->user()->id === $article->user_id)
                <a class= "btn btn-warning"
                    href=" {{ url("/articles/delete/$article->id") }} ">
                    delete
                </a>
                @endif
                
            </div>
        </div>

        <ul class="list-group">
            <li class="list-group-item active">
                <b>Comments ({{ count($article->comments) }}) </b>
            </li>
            @foreach($article->comments as $comment)
                <li class="list-group-item">
                    {{ $comment->content }}

                    <a href="{{ url("/comments/delete/$comment->id") }}"
                        class="close">
                        &times;
                    </a>

                    <div class="small mt-2">
                        By <b> {{ $comment->user->name }}</b>
                        {{ $comment->created_at->diffForHumans() }}
                    </div>
                </li>
            @endforeach
        </ul>

        @auth
        <form action="{{ url('/comments/add') }}" method="post">
            @csrf
            <input type="hidden" name="article_id"
                value="{{ $article->id }}">
            <textarea name="content" class="form-control mb-2"
                placeholder="New Comment"></textarea>
            <input type="submit" value="Add Comment"
                class="btn btn-secondary">
        </form>
        @endauth
    </div>
@endsection

</body>
</html>

