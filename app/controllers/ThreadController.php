<?php

class ThreadController extends BaseController {

    public function getThread($id) {
        $thread = ForumThread::find($id);
        if($thread == null) {
            return Redirect::route('forum-home')->with('fail', "That thread doesn't exist.");
        }

        $author = $thread->author()->first()->username;
        $comments = $thread->comments()->paginate(10);
        $thread->visits_counter++;
        $thread->save();
        return View::make('forum.thread')->with('thread', $thread)->with('author', $author)->with('comments', $comments);
    }

    public function create($id)
    {
        return View::make('forum.newthread')->with('id', $id);
    }

    public function store($id)
    {
        $category = ForumCategory::find($id);
        if($category == null)
        {
            Redirect::route('forum-get-new-thread')->with('fail', "You posted to an invalid category.");
        }

        $validator = Validator::make(Input::all(), array(
            'title' => 'required|min:3|max:255',
            'body' => 'required|min:10|max:65000'
        ));

        if($validator->fails()) {
            return Redirect::route('forum-get-new-thread', $id)->withInput()->withErrors($validator)->with('fail', "Your input doesn't match the requirements.");
        }
        else {
            $thread = new ForumThread;
            $thread->title = Input::get('title');
            $thread->body = Input::get('body');
            $thread->category_id = $id;
            $thread->author_id = Auth::user()->id;

            if($thread->save()) {
                return Redirect::route('forum-thread', $thread->id)->with('success',"Your thread has been saved.");
            }
            else {
                return Redirect::route('forum-get-new-thread', $id)->with('fails',"An error occurred while saving your thread.")->withInput();
            }
        }
    }

    public function delete($id) {
        $thread = ForumThread::find($id);
        if($thread == null) {
            return Redirect::route('forum-home')->with('fail', "That thread doesn't exist.");
        }

        if($thread->delete()) {
            return Redirect::back()->with('success', 'The thread was deleted.');
        } else {
            return Redirect::back()->with('fail', 'An error occurred while deleting the thread.');
        }
    }
}