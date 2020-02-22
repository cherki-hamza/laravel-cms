<?php

namespace App\Http\Controllers;


use App\Profile;
use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function index(){
        return view('users.index')->with('users' , User::all());
    }

    // show form create new user
    public function create(){
        return view('users.create')->with('users' , User::all());
    }

    // change writer user to admin
    public function makeAdmin(User $user){
        $user->role = "admin";
        $user->save();
        session()->flash('success' , 'the role of user change from writer to admin');
        return redirect(route('users.index'));
    }

    // change Admin to writer user to admin
    public function makeWriter(User $user){
        $user->role = "writer";
        $user->save();
        session()->flash('success' , 'the role of user change from admin to writer ');
        return redirect(route('users.index'));
    }

    // show and edit the profile
    public function edit(User $user){
        $profile = $user->profile;
      return view('users.profile' , ['user' => $user , 'profile'=> $profile]);
    }

    // show single profile
    public function show(User $user){
        $profile = $user->profile;
        return view('users.user' , ['user' => $user , 'profile'=> $profile]);
    }

    // update profile
    public function update(User $user , Request $request){
        // get the profile bu id
        $profile = $user->profile;
        // get the all input data from form
        $data = $request->all();
        // check if there'is a picture file in the request
        if ($request->hasFile('picture')){
           $picture = $request->picture->store('profilesPicture' , 'public');
           $data['picture'] = $picture;
        }
        // update profile
        $profile->update($data);

        // the success message
        session()->flash('success' , 'the user profile updated successfully');
        // redirect in the view profile
        return redirect(route('users.edit' , $user->id));

    }
}
