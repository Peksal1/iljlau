<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QnAController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\AuthenticationController;


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

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::post('/topics',[QnAController::class,'newtopic'] ); /// Store a new topic to the database
    Route::post('/posts',[QnAController::class,'newpost'] ); /// Store a new post to the database
    Route::put('/topics/{id}', [QnAController::class,'update_topic']); /// User editing
    Route::put('/posts/{id}', [QnAController::class,'update_post']); /// User editing
    Route::get('/topics',[QnAController::class,'topiclist'] ); /// Returns the list of topics
    Route::get('/posts',[QnAController::class,'postlist'] ); /// Returns the list of topics
    Route::get('/topics/search/{topic_title}', [QnAController::class,'topic_search']); /// topic search
});

Route::post('/create-account', [UserController::class, 'createAccount']);
//login user
Route::post('/login', [UserController::class, 'login']);
//using middleware
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });
    Route::post('/sign-out', [UserController::class, 'logout']);
});

///QnA Api


Route::get('/topic/{id}/post',[QnAController::class,'topic_posts'] ); /// Returns a list of topics in a post

Route::delete('/topics/{id}',[QnAController::class,'destroy_topic'] ); /// Information about a specific portfolio item
Route::delete('/posts/{id}',[QnAController::class,'destroy_post'] ); /// Information about a specific portfolio item



///Portfolio Api

Route::post('/portfolio',[PortfolioController::class,'store'] ); /// Store a new item to the portfolio
Route::get('/portfolio',[PortfolioController::class,'index'] ); /// All of the portfolio items
Route::delete('/portfolio/{id}',[PortfolioController::class,'destroy'] ); /// Information about a specific portfolio item
Route::put('/portfolio/{id}', [PortfolioController::class,'update']); /// User editing
Route::get('/portfolio/search/{name}', [PortfolioController::class,'portfolio_search']); /// Search a work in the portfolio by its name
///User Api

Route::get('/users', [UserController::class,'index']); /// User list
Route::get('/users/{id}', [UserController::class,'show']); /// User list
Route::post('/users', [UserController::class,'store']); /// New user 
Route::delete('/users/{id}', [UserController::class,'destroy']); /// User deleting
Route::put('/users/{id}', [UserController::class,'update']); /// User editing
Route::get('/user/{id}/feedback', [UserController::class,'userfeedback']); /// Users feedback
Route::get('/user/{id}/posts', [UserController::class,'userposts']); /// Users posts
Route::get('/user/search/{name}', [UserController::class,'user_search']); /// Search user by name
///Messages api

Route::get('/messages', [ContactsController::class,'index']); /// Message list
Route::post('/messages', [ContactsController::class,'store']);; /// New message
Route::delete('/messages/{id}', [ContactsController::class,'destroy']); /// Deleting a message

///Feedback api
Route::get('/feedback', [FeedbackController::class,'index']); /// Feedback list
Route::post('/feedback', [FeedbackController::class,'store']); /// New feedback
Route::delete('/feedback/{id}', [FeedbackController::class,'destroy']); /// Deleting feedback
Route::put('/feedback/{id}', [FeedbackController::class,'feedbackedit']); /// Editing feedback
