@extends('layouts.master')

@section('head')
@parent
<title>Reset Password</title>
@stop

@section('content')
<div style="padding-top: 20%; margin-left: 40%">
    <form action="{{ action('RemindersController@postReset') }}" method="POST">
        <input type="hidden" name="token" value="{{ $token }}">
        <label>Email</label>
        <input class="form-control" type="email" name="email">
        <label>New Password</label>
        <input class="form-control" type="password" name="password">
        <label>New Password Again</label>
        <input class="form-control" type="password" name="password_confirmation">
        <input class="btn btn-primary" type="submit" value="Reset Password">
        <p><?php
            if (Session::has('error'))
            {
                echo Session::get('error');
            }
            ?>
        </p>
    </form>
</div>
@stop