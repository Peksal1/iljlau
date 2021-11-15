<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{

    public function index()
    {
        $feedbacks=Feedback::all();
    return $feedbacks;
    
    }
    public function store(Request $request)
    {
        $request->validate([
            'user_id'=>'required',
            'evaluation'=>'required',
            'pros'=>'required',
            'cons'=>'required',
              ]);
        
              return  Feedback::create($request->all());
    
    }


    public function destroy($feedback)
    {
        $feedbacks=Feedback::destroy($feedback);
    
        return response()->json($feedbacks,204);
    
    }

    public function feedbackedit(Request $request, $feedback)

    {
      
        $feedbacks= Feedback::find($feedback);
            $feedbacks->update($request->all());
            return  $feedbacks;
    }

}
