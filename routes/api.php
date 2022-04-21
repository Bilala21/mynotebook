<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\NoteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// note book api routes

Route::post('/register', [AuthController::class,'register']);
Route::post('/login', [AuthController::class,'login']);

//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class,'logout']);
    Route::post('/item-comments', [NoteController::class,'Itemcomments']);
    Route::get("/comments-on-note/{id}",[NoteController::class,'CommentsOnNote']);
    Route::post('/note-comments', [NoteController::class,'Notecomments']);
    Route::post('/comment-reply', [NoteController::class, 'commentReply']);
    Route::get('/profile', function(Request $request) {return auth()->user();});
    Route::post('/share-notes', [NoteController::class,'shareNotes']);
    Route::post('/assign-item', [NoteController::class,'assignItem']);
    Route::get('/pin-item', [NoteController::class,'pinItem']);
    Route::get('/all-items/{id}', [NoteController::class,'allItems']);
    Route::get('/show-pin-note', [NoteController::class,'showAllPinNotes']);
    Route::post('/add-note', [NoteController::class,'addNote']);
    Route::get('/my-notes', [NoteController::class,'myNote']);
    Route::put('/update-note/{id}', [NoteController::class,'updateNote']);
    Route::get('/show-shared-note', [NoteController::class,'showSharedNote']);
    Route::delete('/delete-note/{id}', [NoteController::class,'trashNote']);
    Route::post('/add-item', [NoteController::class,'addItem']);
    Route::put('/update-item/{id}', [NoteController::class,'updateItem']);
    Route::get('/show-assign-item', [NoteController::class,'showAssignItem']);
    Route::delete('/delete-item/{id}', [NoteController::class,'trashItem']);
    Route::get('/all-users', [AuthController::class,'allUsers']);
    Route::get("/single-note/{id}",[NoteController::class,'singleNote']);
    Route::get("/update-item-status/{id}",[NoteController::class,'updateItemStatus']);
     Route::post("/arrange-items",[NoteController::class,'arrangeItem']);
});
