@extends('layouts.master')

@section('head')
    @parent
    <title>New Thread</title>
@stop

@section('content')
    <h1>New Thread</h1>

    <form action="{{ URL::route('forum-store-thread', $id) }}" method="post">
        <div class="form-group">
            <label for="title">Title: </label>
            <input class="form-control" type="text" name="title" id="title"/>
        </div>
        <div class="form-group">
            <label for="body">Body: </label>
            <textarea class="form-control" name="body" id="body"></textarea>
        </div>
        <div class="form-group">
            <label for="title">Tags: </label>
            <input class="form-control" type="text" name="tags"/>
        </div>
        {{ Form::token() }}
        <div class="form-group">
            <input type="submit" value="Save Thread" class="btn btn-primary"/>
        </div>
    </form>

@stop