<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        // return $posts;
        return UserResource::collection($users);
    }

    public function create(Request $request)
    {
        $validator = $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'username' => 'required|unique:users',
            'level'    => 'required',
            'password' => 'required',
        ]);

        $user = User::create($validator);
    }
}
