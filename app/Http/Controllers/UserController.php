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
        
        $list1 = Book::where('tagId', 1)->get();
        $list2 = Book::where('tagId', 2)->get();;
        $list3 = Book::where('tagId', 3)->get();;

        return response()->json([
            'wantToRead' => $list1,
            'currentlyReading' => $list2,
            'read' => $list3
        ], 200);
    }

    public function tagBook(Request $request) {

       
        $input = $request->all();
        // $book = book where unique = $request uniqueBook
        // add to user
        
        // query to see if uniqueBook exists in DB
        $book = Book::where('unique', $request->input('uniqueBook'))->get();
        // dd($book);
        $userHasBook = false;
        
        if ($book->count() > 0) {
            //if book exists check if user already has book
            $user = User::find($request->input('userId'));
            
            $hasBook = $user->books()->where('id', $book->first()->id())->get();
            
            if($hasBook->count() > 0) {
                // if hasBook, return message 
                $userHasBook = true;
            } 

        } else {
            //if book doesn't exist, create book 
            $newBook = [
                "unique" => $request->input("uniqueBook"),
                "userId" => $request->input("userId"),
                "tagId" => $request->input("tagId"),
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
            $userHasBook = false;
        } 

        if($userHasBook){
            return response()->json(['message' => 'You already have this book!'], 404);
        } else {
            return response()->json(['message' => 'Book Added.'], 200);
        }

    }
     
}

