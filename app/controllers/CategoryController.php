<?php

class CategoryController extends BaseController {

    public function getCategory($id) {
        $category = ForumCategory::find($id);
        if($category == null) {
            return Redirect::Route('forum-home')->with('fail', "That category doesn't exist.");
        }

        $threads = $category->threads()->paginate(20);
        $lastPosts = array();
        foreach($threads as $th) {
            $lastPosts[] = $th->comments()->orderBy('created_at', 'desc')->first();
        }

        return View::make('forum.category')
            ->with('category', $category)
            ->with('threads', $threads)
            ->with('lastPosts', $lastPosts);
    }

    public function delete($id) {
        $category = ForumCategory::find($id);
        if($category == null) {
            return Redirect::route('forum-home')->with('fail', 'That category doesn\'t exist.');
        }

        if($category->delete()) {
            return Redirect::route('forum-home')->with('success', 'The category was deleted.');
        } else {
            return Redirect::route('forum-home')->with('fail', 'An error occurred while deleting the category.');
        }
    }

    public function store($id)
    {
        $validator = Validator::make(Input::all(), array(
            'category_name' => 'required|unique:forum_categories,title'
        ));

        if ($validator->fails())
        {
            return Redirect::route('forum-home')->withInput()->withErrors($validator)->with('category-modal', '#category_modal')->with('group-id', $id);
        }
        else
        {
            $group = ForumGroup::find($id);
            if ($group == null)
            {
                return Redirect::route('forum-home')->with('fail', "That group doesn't exist.");
            }
            $category = new ForumCategory;
            $category->title = Input::get('category_name');
            $category->author_id = Auth::user()->id;
            $category->group_id = $id;
            if($category->save())
            {
                return Redirect::route('forum-home')->with('success', 'The category was created');
            }
            else
            {
                return Redirect::route('forum-home')->with('fail', 'An error occured while saving the new category.');
            }
        }
    }
}