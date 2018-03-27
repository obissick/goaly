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
        
        return view('home')
                ->with('goal',json_encode($goal,JSON_NUMERIC_CHECK))
                ->with('completed',json_encode($completed,JSON_NUMERIC_CHECK))
                ->with('created',json_encode($created,JSON_NUMERIC_CHECK));
    }
}
