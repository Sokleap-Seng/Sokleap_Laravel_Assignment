<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    //
    public $books = [
        ['id'=> '1' , 'title'=>'Pride and Prejudice', 'authorld'=>'authorld 1', 'isbn'=>'12345', 'publicationYear'=>'2023', 'genre'=>'Romance', 'availableCopies'=>'1'],
        ['id'=> '2' , 'title'=>'Breaking the Silence', 'authorld'=>'authorld 2', 'isbn'=>'21346', 'publicationYear'=>'2024', 'genre'=>'Drama', 'availableCopies'=>'2'],
        ['id'=> '3' , 'title'=>'Mind Trap', 'authorld'=>'authorld 3', 'isbn'=>'82943', 'publicationYear'=>'2025', 'genre'=>'Thriller', 'availableCopies'=>'3'],
    ];

    // get data books
    public function index(){
        return response()->json([
            'message' => 'Data return success',
            'data' => $this->books,
        ],200);
    }

    // show book specific by id
    public function show($id)
    {
        foreach ($this->books as $book) {
            if ($book['id'] === $id) {
                return response()->json([
                    'message' => 'Book found',
                    'data' => $book
                ], 200);
            }
        }
        return response()->json(['message' => 'Book not found'], 404);
    }

    // create data book
    public function create(Request $request, string $id)
    {
        return response()->json([
            'message' => 'Success create',
            'data' => [
                'id'=>$id,
                'title' => $request->title,
                'authorId' => $request->authorId, 
                'isbn' => $request->isbn,
                'publicationYear' => $request->publicationYear,
                'genre' => $request->genre,
                'availableCopies' => $request->availableCopies,
            ],
        ], 201);
    }

    //  Update an existing book by its ID
  public function update(Request $request, $id)
    {
        foreach ($this->books as $index => $book) {
            if ($book['id'] == $id) {
                // If no data is sent, return the current book data
                if (empty($request->all())) {
                    return response()->json([
                        'message' => 'Showing current book.',
                        'book' => $book
                    ]);
                }
                // If data is sent, overwrite with request data
                $this->books[$index] = $request->all();

                return response()->json([
                    'message' => 'Book updated successfully',
                    'book' => $this->books[$index]
                ]);
            }
        }
        return response()->json(['message' => 'Book not found'], 404);
    }

    // DELETE /api/books/{id}: Delete a book by its ID
    public function delete($id)
    {
        foreach ($this->books as $index => $book) {
            if ($book['id'] == $id) {
                unset($this->books[$index]);

                return response()->json([
                    'message' => 'Book deleted successfully',
                    'id'=> $id,
                ]);
            }
        }
        return response()->json(['message' => 'Book not found'], 404);
    }
}
