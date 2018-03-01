<?php

namespace App\Http\Controllers;

use Auth;
use App\Goal;
use Illuminate\Http\Request;

class GoalController extends Controller
{
     
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $goals = Goal::where('user_id', Auth::user()->id)->paginate(30);
        return view('goals.list', compact('goals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('goals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $private;
        if($request->get('private') == 'on'){
            $private = 1;
        }
        else{
            $private = 0;
        }
        $goal = new Goal([
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'user_id' => Auth::user()->id,
            'target_date' => $request->get('target-date'),
            'is_private' => $private,
          ]);
          $goal->save();
  
          return redirect('goal');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $goal = Goal::findOrFail($id);

        return view('goals.view')->withTask($goal);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $goal = Goal::find($id);

        if($goal->is_private == 1){
            $goal['is_private'] = 'on'; 
        }
        else{
            $goal['is_private'] = 'off';
        }
        return view('goals.edit', compact('goal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Goal::find($id)->update($request->all());
        return redirect()->route('goal.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Goal::find($id)->delete();
        return redirect()->route('goal.index');
    }
}
