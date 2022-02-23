<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use SebastianBergmann\Environment\Console;

class UserController extends Controller
{
    public function listUsers(Request $request)
    {
        $users = User::get();
        
        if (session()->has('success')) {
            return view('backend.users.index')->with(['users' => $users, 'success' => session('success')]);
        } elseif (session()->has('error')) {
                 return view('backend.users.index')->with(['users' => $users, 'error' => session('error')]);
        }

        return view('backend.users.index')->with(['users' => $users]);
    }

    public function createUser(Request $request)
    {
        return view('backend.users.create');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            // 'password' => 'required|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password'
        ]);
        
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        if ($user->id) {
            return redirect()->route('users')->with(['success' => 'User create successfully.']);
        } else {
            return redirect()->route('users')->with(['error' => 'user not created']);
        }
 
    }

    public function editUser($uid)
    {
        $user = User::find($uid);

        if (!$user && empty($user)) 
        {
            return redirect()->route('users');
        }

        return view('backend.users.edit')->with(['user' => $user]);
    }

    public function updateUser(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'email' => 'required',
        ]);
        
        $user = User::find($request->id);

        if ($request->confirm_password || $request->password || $request->current_password) {
            
            $request->validate([
                'password' => 'required|min:6',
                'confirm_password' => 'required|min:6|same:password',
                'current_password' => 'required',
            ]);

            if (Hash::check($user->password, $request->current_password)) {
                $user->password = Hash::make($request->password);                
            } else {
                return redirect()->route('users')->with(['error' => 'Your old password id wrong.']);
            }
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        
        if ($user->id) {
            return redirect()->route('users')->with(['success' => 'User create successfully.']);
        } else {
            return redirect()->route('users')->with(['success' => 'User create successfully.']);
        }

    }

    public function deleteUser($uid)
    {
        User::find($uid)->delete();

        return redirect()->route('users');
    }
}
