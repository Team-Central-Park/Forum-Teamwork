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
            <a data-thread-id="{{ $thread->id }}" href="#" data-toggle="modal" data-target="#thread_modal" class="btn btn-success btn-xs pull-right edit_thread">Edit Thread</a>
        @endif
    </div>
    
    <div class="well">
        <h1>{{ $thread->title }}</h1>
        <h5><em>Visits: {{ $thread->visits_counter }}</em></h5>
        <h4>By: <strong>{{ $author }}</strong> on {{ $thread->created_at }}</h4>
        <hr/>
        <p>{{ nl2br(BBCode::parse($thread->body)) }}</p>
        <hr/>
        <div class="tags-container">
            <span>Tags: </span>
            @foreach($thread->tags as $tag)
            <div class="tag hvr-back-pulse tag">
                <a href="{{ URL::route('get-tag' , $tag->tag) }}">{{ $tag->tag }}</a>
                @if(Auth::check() && (Auth::user() -> isAdmin() || Auth::user()->id === $thread->author_id))
                    <button class="btn-xs btn-danger remove-tag" data-tag-name="{{ $tag->tag }}" data-thread-id="{{ $thread->id }}" title="Remove this Tag">X</button>
                @endif
            </div>
            @endforeach
            @if(Auth::check() && (Auth::user() -> isAdmin() || Auth::user()->id === $thread->author_id))
                <input class="new-tag-name" placeholder="Tag">
                <button class="btn-xs btn-success save-tag" data-thread-id="{{ $thread->id }}">Save</button>
                <button class="btn glyphicon glyphicon-plus hvr-grow hvr-grow-shadow add-tag"></button>
            @endif
        </div>
    </div>

    @foreach($comments as $key=>$comment)
        <div class="well">
            <h4>By: <strong>{{ $comment->author->username }}</strong> on {{ $comment->created_at }}</h4>
            @if ($comment->created_at != $comment->updated_at)
                <h4 class="pull-right">Edited on: {{ $comment->updated_at }}</h4>
            @endif
            <h4>Comments: {{ $commentsPerUser[$key] }}</h4>
            <h4>Title:
                @if ($commentsPerUser[$key] < 20)
                    Newbie
                @elseif ($commentsPerUser[$key] < 50)
                    Junior
                @elseif ($commentsPerUser[$key] < 150)
                    Average
                @elseif ($commentsPerUser[$key] < 300)
                    Senior
                @elseif ($commentsPerUser[$key] < 600)
                    Master
                @elseif ($commentsPerUser[$key] < 1200)
                    God
                @else
                    Above God
                @endif
            </h4>
            <hr/>
            <p class="comment-content">{{ nl2br(BBCode::parse($comment->body)) }}</p>
            @if(Auth::check() && (Auth::user() -> isAdmin() || Auth::user()->id === $comment->author->id))
                <a class="btn btn-danger" href="{{ URL::route('forum-delete-comment', $comment->id) }}">Delete Comment</a>
                <button class="btn btn-success edit-comment">Edit Comment</button>
                <button class="btn btn-danger cancel-edit-comment">Cancel</button>
                <button class="btn btn-success send-edited-comment" data-comment-id="{{ $comment->id }}">Save</button>

                <div class="alert alert-success success-alert" hidden="hidden">
                    <strong>Success! </strong>
                    This comment was edited.
                </div>
                <div class="alert alert-danger error-alert" hidden="hidden">
                    <strong>Error! </strong>
                    Something goes wrong!
                </div>
            @endif
        </div>
    @endforeach

    {{ $comments->links(); }}

    @if(Auth::check())
        <form action="{{ URL::route('forum-store-comment', $thread->id) }}" method="post" id="forumComment">
            <div class="form-group">
                <label for="body">Write comment: </label>
                <textarea class="form-control" name="body" id="body"></textarea>
            </div>
            {{ Form::token() }}
            <div class="form-group">
                <input type="submit" value="Publish" class="btn btn-primary"/>
            </div>
        </form>

    @endif

    <div class="modal fade" id="thread_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-dissen="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">Edit Thread</h4>
                </div>
                <div class="modal-body">
                    <form id="thread_form" method="post">
                        <div class="form-group {{ ($errors->has('category_name')) ? ' has-error' : ''}}">
                            <label for="thread_title">Thread Title:</label>
                            <input type="text" id="thread_title" name="thread_title" class="form-control" value="{{ $thread->title }}">
                            @if($errors->has('thread_title'))
                            <p>{{ $errors->first('thread_title') }}</p>
                            @endif
                            <label for="thread_body">Body: </label>
                            <textarea class="form-control" id="thread_body" name="thread_body">{{ $thread->body }}</textarea>
                            @if($errors->has('thread_body'))
                            <p>{{ $errors->first('thread_body') }}</p>
                            @endif
                        </div>
                        {{ Form::token() }}
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="thread_submit">Save</button>
                </div>
            </div>
        </div>
    </div>
@stop