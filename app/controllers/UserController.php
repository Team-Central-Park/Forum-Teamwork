<?php

class UserController extends BaseController {

    //gets view for register page
    public function getCreate() {
        return View::make('user.register');
    }

    //gets view for login page
    public function getLogin() {
        return View::make('user.login');
    }

    public function postCreate()
    {
        $validate = Validator::make(Input::all(), array(
            'username' => 'required|unique:users|AlphaDash|min:6',
            'pass1' => 'required|AlphaNum|min:6',
            'pass2' => 'required|AlphaNum|same:pass1',
            'email' => 'required|unique:users|Email'
        ));
        if ($validate->fails())
        {
            return Redirect::route('getCreate')->withErrors($validate)->withInput();
        }
        else
        {
            $user = new User();
            $user->username = Input::get('username');
            $user->password = Hash::make(Input::get('pass1'));
            $user->email = Input::get('email');
            if ($user->save())
            {
                return Redirect::route('home')->with('success', 'You registed successfully. You can now login.');
            }
            else
            {
                return Redirect::route('home')->with('fail', 'An error occured while creating the user. Please try again.');
            }
        }
    }
    public function postLogin()
    {
        $validator = Validator::make(Input::all(), array(
            'username' => 'required',
            'pass1' => 'required'
        ));

        if($validator->fails())
        {
            return Redirect::route('getLogin')->withErrors($validator)->withInput();
        }
        else
        {
            $remember = (Input::has('remember')) ? true : false;
            $auth = Auth::attempt(array(
                'username' => Input::get('username'),
                'password' => Input::get('pass1')
            ), $remember);
            if($auth)
            {
                return Redirect::route('forum-home');
            }
            else
            {
                return Redirect::route('getLogin')->with('fail', 'You entered the wrong login credentials, please try again!');
            }
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return Redirect::route('home');
    }
}
?>