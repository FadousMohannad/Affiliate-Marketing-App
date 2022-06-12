<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Models\User;
use App\Models\registered_user;
use Illuminate\Support\Facades\DB;


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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        if(empty(auth()->user()->referral_link) && auth()->user()->role != "admin") {
            
            $user = User::find(auth()->user()->id);
            $user->referral_link = URL::signedRoute('register', ['user' => auth()->user()->id]);
            $user->save();
        }

        if(auth()->user()->role == "admin") {
            $registered_users = User::where('id','<>', auth()->id())->paginate();
        }
        else $registered_users = registered_user::where('user_id',auth()->id())->paginate();
        
        
        return view('home')->with([
            'referral_link'    => auth()->user()->referral_link,
            'registered_users' => $registered_users
        ]);
    }
}
