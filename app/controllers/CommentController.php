<?php

class CommentController extends BaseController {

    public function store($id) {
        $thread = ForumThread::find($id);
        if($thread == null) {
            Redirect::route('forum-home')->with('fail', "That thread doesn't exist.");
        }

        $validator = Validator::make(Input::all(), array(
            'body' => 'required|min:5'
        ));

        if($validator->fails()) {
            return Redirect::route('forum-thread', $id->withInput()->withErrors($validator)->with('fail', 'Please fill in the form correctly!'));
        }
        else {
            $comment = new ForumComment();
            $comment->body = Input::get('body');
            $comment->author_id = Auth::user()->id;
            $comment->thread_id = $id;

            if($comment->save()) {
                return Redirect::route('forum-thread', $id)->with('success', 'The comment was saved.');
            }
            else {
                return Redirect::route('forum-thread', $id)->with('fail', 'An error occurred while saving.');
            }
        }
    }

    public function delete($id) {
        $comment = ForumComment::find($id);
        if($comment == null) {
            return Redirect::route('forum-home')->with('fail', "That comment doesn't exist.");
        }

        $thread_id = $comment->thread->id;
        if($comment->delete()) {
            return Redirect::route('forum-thread', $thread_id)->with('success', "That comment was deleted.");
        } else {
            return Redirect::route('forum-thread', $thread_id)->with('fail', "An error occurred while deleting the comment.");
        }
    }

    public function edit($id) {
        $comment = ForumComment::find($id);
        if (!(Auth::user()->isAdmin() || $comment->author->id === Auth::user()->id)) {
            echo 0;
            return;
        }

        $validator = Validator::make(Input::all(), array(
            'body' => 'required|min:5'
        ));

        if($validator->fails()) {
            echo 0;
            return;
        }

        $comment->body = e(Input::get('body'));
        if ($comment->save()) {
            echo 1;
        } else {
            echo 0;
        }
    }
}