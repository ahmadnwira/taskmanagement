<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Database\QueryException;

use App\User;

class RegistrationController extends Controller
{
     /**
     * Show the form for creating a new User.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('registration.create');
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => "required|min:3",
            'email' => "required|email",
            'password' => "required|confirmed|min:4",
        ]);

        try{
            $user = User::create([
                    'name'=>$request->get('name'),
                    'email'=> $request->get('email'),
                    'password'=> bcrypt($request->get('password'))
                ]);
        }
        
        catch(QueryException $e){
            if($e->errorInfo[0] == 23000){
                return redirect(route('register.create'))->with(['error' => 'this email already exisits.!']);
            }
            return response()->view('errors.500', [], 500);
        }

        \Auth::login($user);

        return redirect('/');
    }
}
