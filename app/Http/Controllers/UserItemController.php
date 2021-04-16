<?php

namespace App\Http\Controllers;

use App\Models\UserItem;
use Illuminate\Http\Request;
use Alert, Response, Hash, Session;
use Carbon\Carbon;


class UserItemController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $useritems=UserItem::whereNull('deleted_at')->get();
        return response()->json($useritems);
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
    public function save(Request $request)
        {
            $item=UserItem::create($request->all());
            return Response::json($item, 200);
        }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserItem  $customerItem
     * @return \Illuminate\Http\Response
     */
    public function show(UserItem $UserItem)
    {
        $pw=Session::get('pw');
        return $pw;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomerItem  $customerItem
     * @return \Illuminate\Http\Response
     */
    public function find($user)
    {
        $item=UserItem::with('company')->whereUserId($user)->first();
        return response()->json($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomerItem  $customerItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserItem $useritem)
    {
        // return $request;
        $input = $request->all();
        $useritem->update($input);
        return Response::json($useritem, 200);
    }
    public function company(Request $request, User $user )
        {
            $user->item->update(['company_id'=>$request->company_id]);
            return Response::json($user, 200);
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserItem  $customerItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserItem $useritem)
    {
        $useritem->deleted_at = Carbon::now();
        $useritem->update();
        return response()->json(array('success'=>true));
    }
    public function getBrgy()
    {
        $jsonString = file_get_contents(base_path('public/js/geolist/barangays.json'));
        $brgys = json_decode($jsonString, true);

        // return response()->json($brgys) ; 
        $finalBrgy=[];
        foreach ($brgys as $key=>$brgy) {
            $newBrgy['id']   = ++$key;
            $newBrgy['name'] = $brgy['name'];
            $newBrgy['mun']  = (int)$brgy['mun_code'];
            array_push($finalBrgy,$newBrgy);
        }
        // Write File
        $newJsonString = json_encode($finalBrgy, JSON_PRETTY_PRINT);
        file_put_contents(base_path('public/js/geolist/barangays.json'), stripslashes($newJsonString));
        return response()->json($finalBrgy) ;      
    }
}
