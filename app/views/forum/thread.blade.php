@extends('layouts.master')

@section('head')
    @parent
    <title>Forum | {{ $thread->title }}</title>
@stop

@section('content')
    <div class="clearfix">
        <ol class="breadcrumb pull-left">
            <li><a href="{{ URL::route('forum-home') }}">Forums</a></li>
            <li><a href="{{ URL::route('forum-category', $thread->category_id) }}">{{ $thread->category->title }}</a></li>
            <li class="active">{{ $thread->title }}</li>
        </ol>

        @if(Auth::check() && Auth::user()->isAdmin())
            <a class="btn btn-danger pull-right" href="{{ URL::route('forum-delete-thread', $thread->id) }}">Delete</a>
        @endif
    </div>
    
    <div class="well">
        <h1>{{ $thread->title }}</h1>
        <h4>By: {{ $author }} on {{ $thread->created_at }}</h4>
        <h5><em>Visits: {{ $thread->visits_counter }}</em></h5>
        <hr/>
        <p>{{ nl2br(BBCode::parse($thread->body)) }}</p>
        <hr/>
        <div class="tags-container">
            <span>Tags: </span>
            @foreach($thread->tags as $tag)
                <a class="hvr-back-pulse" href="{{ URL::route('get-tag' , $tag->tag) }}">{{ $tag->tag }}</a>
            @endforeach
        </div>
    </div>

    @foreach($comments as $comment)
        <div class="well">
            <h4>By: {{ $comment->author->username }} on {{ $comment->created_at }}</h4>
            <hr/>
            <p>{{ nl2br(BBCode::parse($comment->body)) }}</p>
            @if(Auth::check() && Auth::user() -> isAdmin())
                <a class="btn btn-danger" href="{{ URL::route('forum-delete-comment', $comment->id) }}">Delete Comment</a>
            @endif
        </div>
    @endforeach

    {{ $comments->links(); }}

    @if(Auth::check())
        <form action="{{ URL::route('forum-store-comment', $thread->id) }}" method="post" id="forumComment">
            <div class="form-group">
                <label for="body">Body: </label>
                <textarea class="form-control" name="body" id="body"></textarea>
            </div>
            {{ Form::token() }}
            <div class="form-group">
                <input type="submit" value="Save Thread" class="btn btn-primary"/>
            </div>
        </form>

    @endif

@stop