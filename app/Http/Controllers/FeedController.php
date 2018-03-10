<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Goal;
use App\GoalFollower;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FeedController extends Controller
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
        $user = Auth::id();
        $followedGoals = GoalFollower::where('user_id', $user);
        $goals = DB::table('goals')->select(DB::raw('goals.id, goals.title, goals.created_at, goals.target_date, goals.user_id, users.username'))
            ->join('users', 'users.id', '=', 'goals.user_id')
            ->where('is_private', 0)->orderBy('goals.created_at', 'desc')->orderBy('goals.id', 'desc')->paginate(50);
        return view('feed.show', compact('goals', 'user', 'followedGoals'));
    }
}
