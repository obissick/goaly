<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Goal;
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
        #$goals = Goal::orderBy('created_at', 'desc')->paginate(50);
        $goals = DB::table('goals')->select(DB::raw('goals.id, goals.title, goals.created_at, goals.target_date, goals.user_id, users.email'))
            ->join('users', 'users.id', '=', 'goals.user_id')
            ->where('is_private', 0)->orderBy('goals.created_at', 'desc')->paginate(50);
        return view('feed.show', compact('goals', 'user'));
    }
}
