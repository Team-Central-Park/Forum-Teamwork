@extends('layouts.master')

@section('head')
@parent
<title>Reset Password</title>
@stop

@section('content')
<div style="padding-top: 20%; margin-left: 40%">
    <form action="{{ action('RemindersController@postRemind') }}" method="POST">
        <input class="form-control" type="email" name="email" placeholder="Enter Your Email">
        <input class="btn btn-primary" type="submit" value="Send Reminder">
        <p><?php
            if (Session::has('error'))
            {
                echo Session::get('error');
            }

            if (Session::has('status'))
            {
                echo Session::get('status');
            }
            ?>
        </p>
    </form>
</div>
@stop