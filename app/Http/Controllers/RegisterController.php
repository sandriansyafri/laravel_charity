<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('page.backend.auth.register');
    }

    private function validation()
    {
        return request()->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required|same:password',
        ]);
    }
    public function register(Request $request)
    {
        $this->validation();
        $request['role_id'] = 2;
        $request['password'] = Hash::make($request->password);

        User::create($request->all());

        return redirect()->route('login')->with('register_status', 'success');
    }
}
