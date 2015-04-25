<?php
/**
 * Created by PhpStorm.
 * User: Re5PecT
 * Date: 15-4-24
 * Time: 21:19
 */

class TagController extends BaseController{

    public function getTag($name)
    {
        // select * from forum_threads,tags where id = thread_id and tag = 'dfgdfg'
        $threads = ForumThread::whereHas('tags', function($query) use ($name)
            {
                $query->where('tag', '=', $name);
            })->paginate(20);

        $lastPosts = array();
        foreach($threads as $th) {
            $lastPosts[] = $th->comments()->orderBy('created_at', 'desc')->first();
        }

        return View::make('forum.tag')
            ->with('tag', $name)
            ->with('threads', $threads)
            ->with('lastPosts', $lastPosts);

       /*$queries = DB::getQueryLog();
        var_dump(end($queries));*/
    }

    public function delete($name) {
        $tag = Tag::whereIn('tag', array($name))->delete();
        if($tag == null) {
            return Redirect::route('forum-home')->with('success', 'The tag was deleted.');
        }

        return Redirect::route('forum-home')->with('fail', 'An error occurred while deleting the tag.');
    }
} 