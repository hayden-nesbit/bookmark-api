<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Book;
use App\UserTag;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    protected function generateAccessToken($user)
    {
        $token = $user->createToken($user->email.'-'.now());

        return $token->accessToken;
    }


    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'name' => $request->name, 
            'email' => $request->email, 
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken($user->email.'-'.now());

        $user->tags = DB::table("user_tags")->join("books", "user_tags.book_id", "=", "books.id")->where("user_id", $user->id)->get();

        return response()->json([ 
            'token' => $token->accessToken,
            'user' => $user
        ]);
    }
    
    public function login(Request $request)
    {   

    $request->validate([
        'email' => 'required|email|exists:users,email', 
        'password' => 'required'
    ]);



    if( Auth::attempt(['email'=>$request->email, 'password'=>$request->password]) ) {
        $user = Auth::user();
        
        $token = $user->createToken($user->email.'-'.now());

        $user->tags = DB::table("user_tags")->join("books", "user_tags.book_id", "=", "books.id")->where("user_id", $user->id)->get();
        $user->goals = DB::table("user_tags")->join("books", "user_tags.book_id", "=", "books.id")->where("user_id", $user->id)->whereNotNull("end_date")->get();

        return response()->json([
            'token' => $token->accessToken,
            'user' => $user
        ]);
    }
}

public function logout(Request $request)
{
    $request->user()->token()->revoke();
    $request->user()->token()->delete();
    
    $response = 'You have been successfully logged out!';
    
    return response($response, 200);
}

}