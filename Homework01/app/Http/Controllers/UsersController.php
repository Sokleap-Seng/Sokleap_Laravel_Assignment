<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    public $users = [
        [
            'id' => '1', 
            'name' => 
            'Alice Johnson', 
            'email' => 'alice@example.com', 
            'membershipDate' => '2023-01-15'
        ],
        [
            'id' => '2', 
            'name' => 'Bob Smith', 
            'email' => 'bob@example.com', 
            'membershipDate' => '2022-07-20'
        ],
        [
            'id' => '3', 
            'name' => 'Carol Martinez', 
            'email' => 'carol.martinez@example.com', 
            'membershipDate' => '2021-11-05'
        ],
        [
            'id' => '4', 
            'name' => 'David Lee', 
            'email' => 'david.lee@example.com', 
            'membershipDate' => '2020-03-12'
        ],
        [
            'id' => '5', 
            'name' => 'Eva Chen', 
            'email' => 'eva.chen@example.com', 
            'membershipDate' => '2019-08-30'
        ],
    ];

    // Retrieve a list of all library members.
    public function index(){
        return response()->json([
            'message'=>'Users return success',
            'data'=>$this->users,
        ],200);
    }

    // Retrieve a single user by their ID.
    public function show($id){
        foreach($this->users as $user){
            if($user['id'] === $id){
                return response()->json([
                    'message'=>'user found',
                    'data'=> $user
                ],200);
            }
        }
        return response()->json(['message' => 'user not found'], 404);
    }

    // Add a new user.
    public function create(Request $request){
        return response()->json([
            'message'=> 'add new user success',
            'data' =>[
                'id'=> $request->id,
                'name'=> $request->name,
                'email'=> $request->email,
                'membershipDate'=> $request->membershipDate,
            ]
        ],201);
    }

    //  Update an existing user by their ID.
    public function update(Request $request, string $id){
        foreach($this->users as $index => $user){
            if($user['id'] === $id){
                // If no data is sent, return the current user data
                if (empty($request->all())) {
                    return response()->json([
                        'message' => 'Showing current author.',
                        'author' => $user
                    ]);
                }
                // If data is sent, overwrite with request data
                $this->users[$index] = $request->all();
                return response()->json([
                    'message' => 'author updated successfully',
                    'author' => $this->users[$index]
                ]);
            }
        }
        return response()->json(['message' => 'user not found'], 404);
    }

    // Delete a user by their ID.
    public function delete($id){
        foreach($this->users as $index => $user){
            if($user['id'] === $id){
                unset($this->authors[$index]);
                return response()->json([
                    'message' => 'user deleted successfully',
                ]);
            }
        }
        return response()->json(['message' => 'user not found'], 404);
    }
}
