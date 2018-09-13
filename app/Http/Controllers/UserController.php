<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Log;

// User Session 資料
use Auth;

// Validator
use Validator;
use Illuminate\Validation\Rule;
use Hash;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user', [
            'title' => 'List all user',
            'users' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::debug($request->all());
        $validate = Validator::make($request->all(), [
            'name'=>'required',
            'email'=>'required|unique:users',
            'password'=>'required|confirmed'
        ]);
        if ($validate->fails()) {
            return redirect('/user')
                        ->withErrors($validate)
                        ->withInput();
        }
        User::create($request->all());
        return redirect('/user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function show_user(Request $request)
    {
        return isset(Auth::user()->name)? Auth::user()->name: "You haven't login yet" ;
    }

    public function show_session(Request $request)
    {
        return $request->session()->all();
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('user-edit', [
            'user' => User::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Log::debug('update $request= ', $request->all());
        Log::debug($id);
        $validate = Validator::make($request->all(), [
            'name'=>'required',
            'email'=> [
                'required',
                Rule::unique('users')->ignore($id),
            ],
            'password'=>'required|confirmed'
        ]);
        if ($validate->fails()) {            
            return redirect( "/user/$id/edit" )
                        ->withErrors($validate)
                        ->withInput();
        }
        User::where('id', $id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'authority' => $request->authority
            ]);
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect('/user');
    }
}
