<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function create()
    {
        return view('session.create');
    }

    public function store(Request $request)
    {
        if(!\Auth::attempt($request->only('email', 'password')))
        {
            return redirect(route('login'))->with('error', 'invalid username or password.');
        }
        return redirect('/');
    }

    /**
     * Removes user session.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        \Auth::logout();
        return redirect('/');
    }
}
