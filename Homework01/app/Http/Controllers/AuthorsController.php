<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Models\Author;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'Get all authors',
            'data' => Author::all(),
        ], 200);
    }

    public function show($id)
    {
        $author = Author::with('books')->findOrFail($id);
        return response()->json([
            'id' => $author->id,
            'name' => $author->name,
            'bio' => $author->bio,
            'nationality' => $author->nationality,
            'books' => $author->books->pluck('title'),
        ]);
    }

// Validator with requests
    public function create(StoreAuthorRequest $request){
        $author = Author::create($request->all());
        return response()->json([
            'message'=>'author create successfully',
            'data'=> $author
        ],201);
    }

    // Update an existing author by their ID
    public function update(Request $request, $id)
    {
       $author = Author::where('id',$id)->update([
            'name'=>$request-> name,
            'bio'=>$request-> bio,
            'nationality'=>$request->nationality
       ]);
       if($author){
           return response()->json([
                'message'=> "author updated successfully",
            ],201);
        }
            return response()->json(['message' => 'Book not found'], 404);
        }
   
    // // Delete an author by their ID.
    public function delete($id)
    {
        $author = Author::where('id', $id)->delete();
        if ($author ) {
            return response()->json([
                'message' => 'author  deleted successfully',
            ], 201);
        }

        return response()->json([
            'message' => "Failed to delete author"
        ], 203);
    }
}
