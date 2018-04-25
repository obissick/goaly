<?php

namespace App\Http\Controllers;

use Auth;
use App\Goal;
use URL;
use Carbon;
use Illuminate\Support\Facades\DB;
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
        $goals = Goal::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(25);
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
        session()->flash('flash_message', 'Goal created.');
        
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
        $goal = DB::table('goals')->select(DB::raw('users.username, goals.id, goals.title, goals.content, goals.user_id, goals.target_date, goals.completed_date, goals.goal_type_id, goals.created_at, goals.updated_at, goals.is_private'))
            ->join('users', 'users.id', '=', 'goals.user_id')
            ->where('goals.id', $id)->first();
        $comments = DB::table('comments')->select(DB::raw('comments.id, comments.content, comments.created_at, comments.user_id, users.email, users.username'))
            ->join('users', 'users.id', '=', 'comments.user_id')
            ->join('goals', 'goals.id', '=', 'comments.goal_id')
            ->where('goal_id', $goal->id)
            ->orderBy('comments.created_at', 'desc')->paginate(50);
        return view('goals.view', compact('goal', 'comments'));
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

    public function complete($id)
    {
        $goal = Goal::find($id);
        $goal->completed_date = Carbon\Carbon::now();
        $goal->save();
        return redirect()->route('goal.show', ['id' => $id]);
    }

    public function reopen($id)
    {
        $goal = Goal::find($id);
        $goal->completed_date = NULL;
        $goal->save();
        return redirect()->route('goal.show', ['id' => $id]);
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
        session()->flash('flash_message', 'Goal Deleted.');
        return redirect()->back();
    }
}
