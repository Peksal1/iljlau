<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
class UserController extends Controller
{

    public function index()
    {
        $users=User::all();
        return $users;
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
        return response()->json([
        'message' => 'Wrong e-mail or password.'
                   ], 401);
               }
        
        $user = User::where('email', $request['email'])->firstOrFail();
        
        $token = $user->createToken('auth_token')->plainTextToken;
        
        return response()->json([
                   'access_token' => $token,
                   'token_type' => 'Bearer',
        ]);
        }
    

    public function createAccount(Request $request)
    {
        $validatedData = $request->validate([
        'name' => 'required|string|max:255',
                           'email' => 'required|string|email|max:255|unique:users',
                           'password' => 'required|string|min:8|confirmed',
        ]);
        
              $user = User::create([
                      'name' => $validatedData['name'],
                           'email' => $validatedData['email'],
                           'password' => Hash::make($validatedData['password']),
               ]);
        
        $token = $user->createToken('auth_token')->plainTextToken;
        
        return response()->json([
                      'access_token' => $token,
                           'token_type' => 'Bearer',
        ]);
        }


    // this method signs out users by removing tokens
    public function signout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }
    public function show($user)
    {
        $users=User::findOrFail($user);
        return $users;
    }

    public function store(Request $request)

{
    $request->validate([

        'name'=>'required',

        'email'=>'required',

        'password'=>'required',

        

          ]);

    

          return  User::create($request->all());
}


public function userfeedback($id){
    $user = User::where('id', $id)->firstOrFail();



        $user_feedback = $user->feedbacks;

     

        return response()->json($user_feedback, 200, [], JSON_PRETTY_PRINT);
}

public function userposts($id){
    $user = User::where('id', $id)->firstOrFail();



        $user_post = $user->posts;

     

        return response()->json($user_post, 200, [], JSON_PRETTY_PRINT);
}

public function destroy($user)
{
    $users=User::destroy($user);

    return response()->json($users,204);

}
public function update(Request $request, $user)
{
      
    $users= User::find($user);
        $users->update($request->all());
        return  $users;
}
public function user_search(Request $request, $name)
{
    $result = User::where('name', 'LIKE', '%'. $name. '%')->get();
    if(count($result)){
     return Response()->json($result);
    }
    else
    {
    return response()->json(['Result' => 'No users found'], 404);
  }
}

}
