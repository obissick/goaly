<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\GoalLike;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class GoalLikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::id();
        
        $goals = DB::table('goals')->select(DB::raw('goals.id, goals.title, goals.created_at, goals.target_date, goals.user_id, users.username'))
            ->join('users', 'users.id', '=', 'goals.user_id')
            ->join('goal_likes', 'goal_likes.goal_id', '=', 'goals.id')
            ->where('goal_likes.user_id', $user)->orderBy('goals.created_at', 'desc')->orderBy('goals.id', 'desc')->paginate(50);
        
        return view('feed.liked', compact('goals', 'user'));
    }

    public function store(Request $request)
    {
        $goal_like = new GoalLike([
            'user_id' => Auth::user()->id,
            'goal_id' => $request->get('id'),
        ]);
        session()->flash('flash_message', 'Goal liked!');
        $goal_like->save();
  
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        GoalLike::where([
            'user_id' => Auth::user()->id,
            'goal_id' => $request->get('id'),
        ])->delete();
        session()->flash('flash_message', 'Goal unliked!');
        return redirect()->back();
    }
}
