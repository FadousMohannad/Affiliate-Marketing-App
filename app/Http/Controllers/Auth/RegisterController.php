<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\registered_user;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $url = $data['url'];
        // dd($url);
        $user_id = substr($url , strpos($url , 'user=') + strlen('user=') , 1);
        // dd($user_id);
        $user = User::find($user_id);
        // echo $user_id;
        if(!empty($user->id)) {
            $registered_user = new registered_user([
                'name'      => $data['name'],
                'email'     => $data['email'],
                'user_id'   => $user->id,
            ]);

            $registered_user->save();

            $user = User::find($user_id);

            if(!empty($user->id)) {
                if(empty($user->count))
                    $user->count = 1;
                else $user->count++;
                $user->save();
            }  
        } 

        return User::create([
            'name'          => $data['name'],
            'email'         => $data['email'],
            'birth_date'    => $data['birth_date'],
            'password'      => Hash::make($data['password']),
        ]);
    }
    public function index() {

        $url = url()->full();
        $user_id = substr($url , strpos($url , 'user=') + strlen('user=') , 1);

        
        $user = User::find($user_id);

        if(!empty($user->id)) {
            if(empty($user->views))
                $user->views = 1;
            else $user->views++;
        
            $user->save();
        }  

        return view('auth/register');    
        
    }
}
