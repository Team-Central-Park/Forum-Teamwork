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

    public function deleteOne($threadID, $name) {
        $tag = Tag::where('thread_id', '=', $threadID)->where('tag', '=', $name)->first();
        if($tag == null) {
            echo 0;
            return;
        }

        if (!(Auth::user()->isAdmin() || $tag->thread->author_id === Auth::user()->id)) {
            echo 0;
            return;
        }

        if (Tag::where('thread_id', '=', $threadID)->where('tag', '=', $name)->delete()) {
            echo 1;
            return;
        }

        echo 0;
    }

    public function add($threadID, $name) {
        $validator = Validator::make(
            array(
                'id' => $threadID,
                'name' => $name
            ),
            array(
                'id' => 'required|exists:forum_threads,id',
                'name' => 'required|max:50'
        ));

        if($validator->fails()) {
            echo 0;
            return;
        }

        $tag = new Tag();
        $tag->thread_id = $threadID;
        $tag->tag = $name;

        if ($tag->save()) {
            echo 1;
        } else {
            echo 0;
        }
    }
} 