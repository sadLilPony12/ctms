<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response, File, Session;


class UserController extends Controller
{
    //   public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users=User::whereNull('deleted_at')
                    ->where('name', 'like', "%{$request->key}%")
                    ->whereRoleId(3)->get();
        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    public function hasDownloaded(Request $request, User $user)
    {
        $input = $request->all();
        $user->update($input);
        return Response::json($user, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function show(Users $users)
    {
        $password=Session::get('pw');
        return $password;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function find($user)
        { 
            $user=User::find($user);
            return Response::json($user);
        }
    public function look($user)
        { 
            $user=User::with('item')->find($user);
            return Response::json($user);
        }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user)
    {
        if($request->fname){
            $path=public_path("/images/avatar/");
            if(!File::isDirectory($path)){ File::makeDirectory($path, 0777, true, true); }

            $filename = $request->email.'.jpeg';
            $encoded_file=$request->logoU;
            $file = str_replace('data:image/jpeg;base64,', '', $encoded_file);
            $file = str_replace(' ', '+', $file);
            $decode_file   = base64_decode($file);

            if (file_exists("{$path}{$filename}"))  
            { 
                unlink("{$path}{$filename}");
            }

            file_put_contents("{$path}{$filename}", $decode_file);
          

       
        
        

            // if($request->logo){
            //     $path="/images/logo";
            //      if(!File::isDirectory($path)){ File::makeDirectory($path, 0777, true, true); }
            //     $image = $request->logo;

            //      $file = str_replace('data:image/jpeg;base64,', '', $image);
            //     $file = str_replace(' ', '+', $file);
            //     $decode_file   = base64_decode($file);
            
            //     // $filename = "{$request->Name}.{$decode_file->getClientOriginalExtension()}";
            //     // $image->move(public_path($path), $filename);

            //     $request->logo = $filename;
            // };
            // return  $request->logo;
            $user->update([ 
                'profile_picture' => $request->logoU?$filename:'icon.jpg',
                'name'     => $request->Name,
                'phone'    => $request->Phone, 
                'fname'     => $request->Fname,
                'mname'    => $request->Mname,
                'lname'     => $request->Lname,
                'addR'    => $request->AddR, 
                'addP'     => $request->AddP,
                'addC'    => $request->AddC, 
            ]);
            // if ($request->role_id==2) {
            //     return redirect('/admin/article');
            // } else {
            //     return redirect('/user/article');
            // }
            return Response::json($user, 201);     
        }else{
            $user->update($request->all());
            return Response::json($user, 201);
        }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,User $user)
    {
        $user->update([                
            'deleted_at'  => now(),
            'reason'    => $request->reason, 

        ]);
        return Response::json($user, 201);
    }
      public function indexChange()
    {
        return redirect('admin/article');
    } 
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function storeChange(Request $request)
    {
      session()->put('pw', $request->password);
        $request->validate([
            'password' => ['required', new MatchOldPassword],
            'new_password' => ['required', 'min:8'],
            'confirm_password' => ['same:new_password'],
        ]);
        
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
           \Session::flush();
        return redirect('/');
            
    }
}
