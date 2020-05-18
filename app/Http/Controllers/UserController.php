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
use Illuminate\Support\Facades\DB;

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

    public function storeTags() {
        return new UserTagCollection(UserTag::all());
    }

    public function tagBook(Request $request) {

       
        // $input = $request->all();
        // // $book = book where unique = $request uniqueBook
        // // add to user
        
        // // query to see if uniqueBook exists in DB
        // $book = Book::where('unique', $request->input('uniqueBook'))->get();
        // // dd($book);
        // $userHasBook = false;
        
        // if ($book->count() > 0) {
        //     //if book exists check if user already has book
        //     $user = User::find($request->input('user_id'));
            
        //     $hasBook = $user->books()->where('id', $book->first()->id())->get();
            
        //     if($hasBook->count() > 0) {
        //         // if hasBook, return message 
        //         $userHasBook = true;
        //     } 

        // } else {
            //if book doesn't exist, create book 
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
            $newBook = Book::create($newBook);
            $newUserTag = [
                "user_id" => $request->input("user_id"),
                "tag_id" => $request->input("tag_id"),
                "book_id" => $newBook->id,
            ];
            UserTag::create($newUserTag);
            $userHasBook = false;

            $tags = DB::table("user_tags")->join("books", "user_tags.book_id", "=", "books.id")->where("user_id", $request->input("user_id"))->get();

        return response()->json([
            "tags" => $tags
        ]);
        // }
        // if($userHasBook){
        //     return response()->json(['message' => 'You already have this book!'], 404);
        // } else {
        //     return response()->json(['message' => 'Book Added.'], 200);
        // }
    }

    public function deleteBook(Request $request) {
        $tag = UserTag::where("book_id", $request->input("book_id"));
        $book = Book::where("id", $request->input("book_id"));
        $tag->delete();
        $book->delete();

        $tags = DB::table("user_tags")->join("books", "user_tags.book_id", "=", "books.id")->where("user_id", $request->input("user_id"))->get();

        return response()->json([
            "tags" => $tags
        ]);
        
    }

    public function updateBook(Request $request) {
        
        $tag = UserTag::where("tag_id", $request->input("prev_tag"))->where("book_id", $request->input("book_id"))->update(["tag_id" => $request->input("tag_id")]);
        
        $tags = DB::table("user_tags")->join("books", "user_tags.book_id", "=", "books.id")->where("user_id", $request->input("user_id"))->get();

        return response()->json([
            "tags" => $tags
        ]);
    }

    public function setGoal(Request $request) {
        
        $tag = UserTag::where("book_id", $request->input("book_id"))->update(["end_date" => $request->input("end_date")]);
        
        $tags = DB::table("user_tags")->join("books", "user_tags.book_id", "=", "books.id")->where("user_id", $request->input("user_id"))->get();

        return response()->json([
            "tags" => $tags
        ]);
    }


}

     
