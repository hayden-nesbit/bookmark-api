<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserCollection;



class UsersController extends Controller
{
    public function index() {
        return new UserCollection(User::all());
    }

    public function show(Request $request, $userId)
    {
        $user = User::find($userId);

        if($user) {
            return response()->json($user);
        }

        return response()->json(['message' => 'User not found!'], 404);
    }

}