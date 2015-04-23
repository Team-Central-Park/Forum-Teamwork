<?php

class GroupController extends  BaseController {

    public function store() {
        $validator = Validator::make(Input::all(), array(
            'group_name' => 'required|unique:forum_groups,title'
        ));

        if($validator->fails()) {
            return Redirect::route('forum-home')->withInput()->withErrors($validator)->with('modal', '#group_form');
        }
        else{
            $group = new ForumGroup();
            $group->title = Input::get('group_name');
            $group->author_id = Auth::user()->id;

            if($group->save()) {
                return Redirect::Route('forum-home')->with('success', 'The group was created.');
            }
            else {
                return Redirect::Route('forum-home')->with('fail', 'An error occurred while saving the new group.');
            }
        }
    }

    public function delete($id) {
        $group = ForumGroup::find($id);
        if($group == null) {
            return Redirect::route('forum-home')->with('fail', 'That group doesn\'t exist.');
        }

        if($group->delete()) {
            return Redirect::route('forum-home')->with('success', 'The group was deleted.');
        } else {
            return Redirect::route('forum-home')->with('fail', 'An error occurred while deleting the group.');
        }
    }
}