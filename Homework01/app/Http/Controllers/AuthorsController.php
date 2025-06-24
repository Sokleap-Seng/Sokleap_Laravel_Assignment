<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthorRequest;
use App\Models\Author;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    // Retrieve a list of all authors
    public function index(){
        $author = new Author();
        return response()->json([
            'message' => 'Data return success',
            'data' => Author::all(),
        ],200);
    }

    //  Retrieve a single author by their ID
    public function show(int $id)
    {
        $author = Author::where('id', $id)->get();
        if ($author) {
            return response()->json([
                'message' => 'successfully',
                'data' =>  $author
            ], 201);
        }

        return response()->json([
            'message' => "Author id:" . $id . "not found"
        ], 203);
    }

// Add a new author
    // public function create(Request $request){
    //     $author= Author::create([
    //         'name' => $request-> name,
    //         'bio' => $request->bio,
    //         'nationality' => $request->nationality
    //     ]);

    //      if($author){
    //         return response()->json([
    //         'message' => 'create successfuly',
    //         'data' => $author
                
    //     ], 201); 
    //     }
    //     return response()->json([
    //         'message'=>'Author create failed'
    //     ],203);
    // }
    
// Basic Validator  
    // public function create(Request $request){
    //     $validator = Validator::make($request->all(), [
    //         'name'=>"required|string|min:2|max:255",
    //         'bio'=>"string",
    //         'nationality'=>"string",
    //     ]);
        
    //     if($validator->fails()){
    //        return $validator->messages();
    //     }

    //     $author = Author::create($request->all());
    //     return response()->json([
    //         "message" => "Success",
    //         "data" => $author
    //     ]);
    // }

// Validator with requests
    public function create(Request $request){
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
                'data'=>$author
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
