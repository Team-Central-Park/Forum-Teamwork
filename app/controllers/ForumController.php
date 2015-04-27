<?php

class ForumController extends BaseController
{
    public function index() {
        $groups = ForumGroup::all();
        $categories = ForumCategory::all();

        return View::make('forum.index')->with('groups', $groups)->with('categories', $categories);
    }

    public function search() {
        $input = array_map('trim',Input::all());
        $validator = Validator::make($input,
            array(
                'text' => 'required',
                'type' => 'required|numeric'
            ));

        if($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }

        if ($input['type'] == 1) {
            $tag = new TagController();
            return $tag->getTag($input['text']);
        }

        $threads = ForumThread::where('title', 'LIKE', '%' . $input['text'] . '%')->orWhere('body', 'LIKE', '%' . $input['text'] . '%')->paginate(20);

        $lastPosts = array();
        foreach($threads as $th) {
            $lastPosts[] = $th->comments()->orderBy('created_at', 'desc')->first();
        }

        return View::make('forum.tag')
            ->with('tag', $input['text'])
            ->with('threads', $threads)
            ->with('lastPosts', $lastPosts);
    }
}