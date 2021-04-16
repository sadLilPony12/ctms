<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users=User::whereNull('deleted_at')
                    ->where('name', 'like', "%{$request->key}%")
                    ->whereRoleId(2)->get();
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function show(Users $users)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function find(User $User)
        { 
            return Response::json($User);
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
        if($request->Fname){
            $user->update([                
                'name'     => $request->Name,
                'phone'    => $request->Phone, 
                'fname'     => $request->Fname,
                'mname'    => $request->Mname,             
                'lname'     => $request->Lname,
                'addR'    => $request->AddR, 
                'addP'     => $request->AddP,
                'addC'    => $request->AddC, 

            ]);
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
}
