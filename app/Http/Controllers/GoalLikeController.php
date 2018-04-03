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
