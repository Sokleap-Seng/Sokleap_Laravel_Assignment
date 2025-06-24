<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    // Retrieve a list of all books។
     public function index()
    {
        $book = new Book();
        return response()->json([
            "message" => "Successfully!",
            "data" => Book::all(),
        ], 200);
    }

    

    // Retrieve a single book by its ID.
    public function show( string $id)
    {
        $book = Book::where("id",$id)->get();
        if($book){
            return response()-> json([
                "message"=>"Book show success",
                "data"=>$book
            ],200);
        }
        return response()->json([
            "message"=> "book cannot show"
        ],203);
    }

// Add a new book. 
    // public function create(Request $request)
    // {
    //     $book = Book::create([
    //         "title" => $request->title,
    //         "authorId" => $request->authorId, 
    //         "isbn" => $request->isbn,
    //         "publication_year" => $request->publication_year,
    //         "genre" => $request->genre,
    //         "available_copies" => $request->available_copies,
    //     ]);

    //     if ($book) {
    //         return response()->json([
    //             "message" => "Create successful",
    //             "data" => $book
    //         ], 201);
    //     }

    //     return response()->json([
    //         "message" => "Book creation failed"
    //     ], 500);
    // }


// Basic Validator  
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'title'=>"required|string|min:2|max:255",
            'author'=>"string",
            'isbn'=>"string",
            'publication_year'=>"integer",
            'genre'=> "string",
            'available_copies'=>"integer"
        ]);
        
        if($validator->fails()){
           return $validator->messages();
        }

        $book = Book::create($request->all());
        return response()->json([
            "message" => "Success",
            "data" => $book
        ]);
    }


//  Update an existing book by its ID
  public function update(Request $request, $id)
    {
        $book = Book::where("id",$id)-> update([
            "title" => $request->title,
            "authorId" => $request->authorId, 
            "isbn" => $request->isbn,
            "publication_year" => $request->publication_year,
            "genre" => $request->genre,
            "available_copies" => $request->available_copies,
        ]);
        if($book){
            return response()->json([
                "message"=> "Book updated successfully",
            ],201);

        }
        return response()->json([
            "message"=> "Failed to update book"
        ],203);
    }


    // Delete a book by its ID
    public function delete(string $id)
    {
        $book = Book::where("id",$id)->delete();
        if($book){
            return response()->json([
                "message"=>"Delete book success",
            ],200);
        }

        // If book not found
        return response()->json([
            "message" => "Book not found, cannot delete"
        ], 404);
    }
}
