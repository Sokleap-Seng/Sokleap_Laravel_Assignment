<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
   public function index()
    {
        return response()->json([
            'message' => 'Get all authors',
            'data' => Book::all(),
        ], 200);
    }

  public function show($id)
    {
        $book = Book::with('author')->find($id);
        return response()->json([
            'id' => $book->id,
            'title' => $book->title,
            'isbn' => $book->isbn,
            'publication_year' => $book->publication_year,
            'genre' => $book->genre,
            'available_copies' => $book->available_copies,
            'author' => $book->author,
        ]);
    }
    

// Validator with requests
    public function create(StoreBookRequest $request){
        $book = Book::create($request->all());
        return response()->json([
            'message'=>'Book create successfully',
            'data'=> $book
        ],201);
    }


//  Update an existing book by its ID
  public function update(Request $request, $id)
    {
        $book = Book::where("id",$id)-> update([
            "title" => $request->title,
            "author_id" => $request->author_id, 
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
