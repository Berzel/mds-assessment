<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\UpdateProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form to the users profile
     *
     * @return \Illuminate\View\View
     */
    public function edit() : View
    {
        return view('profile.edit', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Update the user profile
     *
     * @param \App\Http\Requests\Profile\UpdateProfileRequest $request
     */
    public function update(UpdateProfileRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $request->user()->update($request->only([
                'name',
                'email',
                'password'
            ]));

            Session::flash('notification', [
                'type' => 'success',
                'message' => 'Profile updated!'
            ]);

            return back();
        });
    }
}
