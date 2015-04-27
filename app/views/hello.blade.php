@extends('layouts.master')

@section('head')
    @parent
    <title>Home Page</title>
@stop

@section('content')
    @if(Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @elseif (Session::has('fail'))
        <div class="alert alert-danger">{{ Session::get('fail') }}</div>
    @endif

    <?php
    	echo "<div class=\"latest-threads row\">";
    	echo "<h3>Latest Threads</h3>";
    	$latestThreads = DB::table('forum_threads')->orderBy('created_at', 'desc')->take(6)->get();
    	foreach ($latestThreads as $thr) {
    		echo "<div class=\"col-md-4\">";
    		echo "<b>$thr->title</b>" . "<br>";
    		$threadAuthor = DB::table('users')->where('id', $thr->author_id)->pluck('username');
    		echo "by: $threadAuthor <br>";
    		$threadLastUpd = new DateTime($thr->updated_at);
    		echo "last update: " . $threadLastUpd->format('d-m-Y H:i:s') . "<br>";
    		echo "</div>";
    	}
    	echo "</div>";

    	echo "<div class=\"latest-comments row\">";
    	echo "<h3>Latest Comments</h3>";
    	$latestComments = DB::table('forum_comments')->orderBy('created_at', 'desc')->take(6)->get();
    	foreach ($latestComments as $comm) {
    		echo "<div class=\"col-md-4\">";
    		echo "<b>$comm->body</b>" . "<br>";
    		$commAuthor = DB::table('users')->where('id', $comm->author_id)->pluck('username');
    		echo "by: $commAuthor <br>";
    		$commLastUpd = new DateTime($comm->updated_at);
    		echo "last edit: " . $commLastUpd->format('d-m-Y H:i:s') . "<br>";
    		echo "</div>";
    	}
    	echo "</div>";
    ?>
	
@stop