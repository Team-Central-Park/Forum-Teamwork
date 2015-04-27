@extends('layouts.master')

@sdection('head')
@parent
<title>Profile</title>
@stop

@section('content')

    <div class="container">
        <h1>Profile: <span class="username-topmenu">{{ Auth::user()->username }}</span></h1>
		
        <form >
		<div>
			 
				<img src="{{Auth::user()->imageURL}}" alt="ProfileImage" height="150" width="150">
				<br><br>
				
				
			<?php
			if(isset($_POST['submit']))
				if($_POST["imgUrl"])
					user()->imageURL=$_POST["imgUrl"];					
			?>
			<form method="post" >
					Image URL:<input id="imgUrll" name="imgUrl" type="text" class="form-control">
					<input type="submit" value="Submit" >
			</form><br><br><br>
			<?php
			
			
			$latestThreads = DB::table('forum_threads')->where('author_id', Auth::user()->id)->take(6)->get();
			foreach ($latestThreads as $thr) {
				$thrLink = URL::route('forum-thread', $thr -> id);
				echo "<div>";
				echo "<a href=\"$thrLink\" class=\"list-group-item homepage-latest-links hvr-fade\">";
				echo "<font size=\"5\"><b>$thr->title&ensp;</b></font>";
				$threadLastUpd = new DateTime($thr->created_at);
				echo "created: " . $threadLastUpd->format('d-m-Y H:i:s') . "<br>";

				echo "</a>";
				echo "</div>";
			}
			?>
			
		</div>
		<div>
		<span >
			
			
             
			 
		
		
		
			
		
		</span>
		</div>
            
        </form>
    </div>
@stop
