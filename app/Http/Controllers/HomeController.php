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
        
        return view('home')
                ->with('goal',json_encode($goal,JSON_NUMERIC_CHECK));
    }
}
