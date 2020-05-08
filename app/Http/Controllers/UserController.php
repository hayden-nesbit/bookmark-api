<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Book;
use App\UserTag;
use App\UserBook;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserTag as UserTagResource;
use App\Http\Resources\UserTagCollection;


class UserController extends Controller
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

    public function getTags() {
        return new UserTagCollection(UserTag::all());
    }

    public function tagBook(Request $request) {
        //1. get book unique id --> check if already have
            //if not, create book
            //if yes, use existing book to create record
                //id of tag + bookid + userid = record
                //return user_book record (response)
            

            $input = $request->all();



        if(!$request->input('uniqueBook')) {
            $newBook = [
                "unique" => $request->input("uniqueBook"),
                "title" => $request->input("bookTitle"),
                "author" => $request->input("bookAuthor"),
                "description" => $request->input("bookDescription"),
                "pageCount" => $request->input("bookPage"),
                "category" => $request->input("bookCat"),
                "image" => $request->input("bookImage"),
                "publisher" => $request->input("bookPub"),
                "pubDate" => $request->input("bookPubDate"),
            ];
            Book::create($newBook);
        } else {
            return response()->json(['message' => 'You already have this book!'], 404);
            // return response()->json(//record)
        }
    }       
}

