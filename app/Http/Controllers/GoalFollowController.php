<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\GoalFollower;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class GoalFollowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::id();
        #$goals = Goal::orderBy('created_at', 'desc')->paginate(50);
        $goals = DB::table('goals')->select(DB::raw('goals.id, goals.title, goals.created_at, goals.target_date, goals.user_id, users.username'))
            ->join('users', 'users.id', '=', 'goals.user_id')
            ->join('goal_followers', 'goal_followers.goal_id', '=', 'goals.id')
            ->where('goal_followers.user_id', $user)->orderBy('goals.created_at', 'desc')->orderBy('goals.id', 'desc')->paginate(50);
        return view('feed.followed', compact('goals', 'user'));
    }
    public function store(Request $request)
    {
        $goalfollow = new GoalFollower([
            'user_id' => Auth::user()->id,
            'goal_id' => $request->get('id'),
          ]);
        $goalfollow->save();
  
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        GoalFollower::where([
            'user_id' => Auth::user()->id,
            'goal_id' => $request->get('id'),
          ])->delete();
        return redirect()->back();
    }
}
