<?php

namespace App\Http\Controllers;

use Auth;
use App\Goal;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $goal = DB::table('goals')
                     ->select(DB::raw('is_private, COUNT(id) as count'))
                     ->where('user_id', Auth::user()->id)
                     ->groupBy('is_private')
                     ->get()->toArray();
        $goal = array_column($goal, 'count');

        $completed = DB::table('goals')
                     ->select(DB::raw('Year(completed_date) as month, COUNT(id) as count'))
                     ->where([['user_id', '=', Auth::user()->id],['completed_date', '<>','', 'and']])
                     ->groupBy('month')
                     ->orderBy('month')
                     ->get()->toArray();
        #$completed = array_column($completed, 'month');

        $created = DB::table('goals')
                     ->select(DB::raw('Year(created_at) as month, COUNT(id) as count'))
                     ->where('user_id', Auth::user()->id)
                     ->groupBy('month')
                     ->orderBy('month')
                     ->get()->toArray();
        
        $liked = DB::table('goal_likes')
                    ->select(DB::raw('COUNT(*) as liked'))
                    ->where('user_id', Auth::user()->id)
                    ->get()->toArray();
        
        $followed = DB::table('goal_followers')
                    ->select(DB::raw('COUNT(*) as followed'))
                    ->where('user_id', Auth::user()->id)
                    ->get()->toArray();

        $goals = DB::table('goals')->select(DB::raw('goals.title, goal_id, COUNT(goal_id) AS likes'))
        ->join('goal_likes', 'goal_likes.goal_id', '=', 'goals.id')
        ->where('goals.user_id', Auth::user()->id)->groupBy('goal_likes.goal_id')->orderBy('likes', 'desc')->limit(5)->get();

        return view('home')
                ->with('goal',json_encode($goal,JSON_NUMERIC_CHECK))
                ->with('completed',json_encode($completed,JSON_NUMERIC_CHECK))
                ->with('created',json_encode($created,JSON_NUMERIC_CHECK))
                ->with('liked',json_encode($liked,JSON_NUMERIC_CHECK))
                ->with('followed',json_encode($followed,JSON_NUMERIC_CHECK))
                ->with('goals');
    }
}
