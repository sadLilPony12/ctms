<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
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
    // protected function create(array $data)
    // {
    //     return User::create([
    //         'name' => $data['name'],
    //         'email' => $data['Remail'],
    //         'role_id'=> $data ['role_id'],
    //         'fname'=> $data ['fname'],
    //         'mname'=> $data ['mname'],
    //         'lname'=> $data ['lname'],
    //         'suffix'=> $data ['suffix'],
    //         'is_male'=> $data ['is_male'],
    //         'dob'=> $data ['pob'],
    //         'email_verified_at'=> $data ['email_verified_at'],
    //         'phone'=> $data['phone'],
    //         'password' => Hash::make($data['Rpassword']),
    //     ]);
    // }

     protected function save(Request $request)
        {
            // return $request;
                      
            $user=User::create([     
                'profile_picture' => $request->ppicture,           
                'role_id'  => 3,
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'fname'    => $request->fname,
                'mname'    => $request->mname,
                'lname'    => $request->lname,
                'suffix'   => $request->suffix,
                'is_male'  => $request->gender,
                'phone'    => $request->phone,
                'dob'  => $request->dob,
                'addR'    => $request->addR,
                'addP'    => $request->addP,
                'addC'    => $request->addC,     
                'addB'    => $request->addB,
                'addPr'    => $request->addPr,
                'addH'    => $request->addH,             
            ]);
            return redirect('/login');
        }
}
