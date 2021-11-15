<?php

namespace App\Http\Controllers;

use App\Models\Messages;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
   
    public function index()
    {
        $messages=Messages::all();
        return $messages;
    }
    public function store(Request $request)
    {
        $request->validate([
    
            'name'=>'required',
    
            'Email'=>'required',
    
            'message'=>'required',
    
            
    
              ]);
    
        
    
              return  Messages::create($request->all());
    }
    public function destroy($message)
  {
    $messages=Messages::destroy($message);

    return response()->json($messages,204);

}
}
