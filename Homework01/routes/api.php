<?php

use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
// Books 
Route::prefix("/books")->group(function(){
    Route::get("/", [BookController::class, "index"]);
    Route::get("/{id}", [BookController::class, "show"]);
    Route::post("/create/{id}", [BookController::class,"create"]);
    Route::put("/update/{id}", [BookController::class,"update"]);
    Route::delete("/delete/{id}", [BookController::class,"delete"]);
});

// Authors
Route::prefix("/authors")->group(function(){
    Route::get("/", [AuthorsController::class, "index"]);
    Route::get("/{id}", [AuthorsController::class, "show"]);
    Route::post("/create", [AuthorsController::class, "create"]);
    Route::put("/update/{id}", [AuthorsController::class, "update"]);
    Route::delete("/delete/{id}", [AuthorsController::class, "delete"]);
});

// Users
Route::prefix("/users")->group(function(){
    Route::get('/', [UsersController::class, 'index']);
    Route::get('/{id}', [UsersController::class, 'show']);
    Route::post('/create', [UsersController::class, 'create']);
    Route::put('/update/{id}', [UsersController::class, 'update']);
    Route::delete('/delete/{id}', [UsersController::class, 'delete']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
