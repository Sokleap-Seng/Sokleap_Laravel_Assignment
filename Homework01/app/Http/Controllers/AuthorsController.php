<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    //
    public $authors = [
        [
            'id' => '1',
            'name' => 'Jane Austen',
            'bio' => 'English novelist known for romance novels.',
            'nationality' => 'British'
        ],
        [
            'id' => '2',
            'name' => 'Mark Twain',
            'bio' => 'American writer and humorist.',
            'nationality' => 'American'
        ],
        [
            'id' => '3',
            'name' => 'Sok Sophak',
            'bio' => 'Khmer poet and writer known for his cultural works.',
            'nationality' => 'Khmer'
        ],
        [
            'id' => '4',
            'name' => 'Chea Sophea',
            'bio' => 'Khmer novelist and storyteller.',
            'nationality' => 'Khmer'
        ],
        [
            'id' => '5',
            'name' => 'Heng Channa',
            'bio' => 'Author of books on Khmer history.',
            'nationality' => 'Khmer'
        ],
    ];

    // Retrieve a list of all authors
    public function index(){
        return response()->json([
            'message' => 'Data return success',
            'data' => $this->authors,
        ],200);
    }

    //  Retrieve a single author by their ID
     public function show($id)
    {
        foreach ($this->authors as $author) {
            if ($author['id'] === $id) {
                return response()->json([
                    'message' => 'author found',
                    'data' => $author
                ], 200);
            }
        }
        return response()->json(['message' => 'author not found'], 404);
    }

    // Add a new author
    public function create(Request $request){
        return response()->json([
            'message'=> "add new author successfully",
            'data'=>[
                'id'=>$request->id,
                'name'=>$request->name,
                'bio'=>$request->bio,
                'nationality'=>$request->nationality,
            ]
        ],201);
    }

    // Update an existing author by their ID
    public function update(Request $request, string $id)
    {
        foreach ($this->authors as $index => $author) {
            if ($author['id'] == $id) {
                // If no data is sent, return the current author data
                if (empty($request->all())) {
                    return response()->json([
                        'message' => 'Showing current author.',
                        'author' => $author
                    ]);
                }
                // If data is sent, overwrite with request data
                $this->authors[$index] = $request->all();

                return response()->json([
                    'message' => 'author updated successfully',
                    'author' => $this->authors[$index]
                ]);
            }
        }
        return response()->json(['message' => 'author not found'], 404);
    }

    // Delete an author by their ID.
    public function delete($id)
    {
        foreach ($this->authors as $index => $author) {
            if ($author['id'] == $id) {
                unset($this->authors[$index]);

                return response()->json([
                    'message' => 'author deleted successfully',
                    'id'=> $id,
                ]);
            }
        }
        return response()->json(['message' => 'author not found'], 404);
    }
}
