<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Portfolio;

use Image;
use Auth;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portfolios=Portfolio::all();
    return $portfolios;
    }

    public function store(Request $request)
    {
        $request->validate([

            'work_name'=>'required',
    
            'file_path'=>'required',
    
            'description'=>'required',
    
            
    
              ]);


              return  Portfolio::create($request->all());
    }

    public function destroy($portfolio)
    {
        $portfolios=Portfolio::destroy($portfolio);
    
        return response()->json($portfolios,204);
    
    }

    public function update(Request $request, $portfolio)
    {
          
        $portfolios= Portfolio::find($portfolio);
            $portfolios->update($request->all());
            return  $portfolios;
    }
    public function portfolio_search(Request $request, $work_name)
    {
        $result = Portfolio::where('work_name', 'LIKE', '%'. $work_name. '%')->get();
        if(count($result)){
         return Response()->json($result);
        }
        else
        {
        return response()->json(['Result' => 'No works found'], 404);
      }
    }
}
