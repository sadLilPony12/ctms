<?php

namespace App\Http\Controllers\Broadcast;

use App\Http\Controllers\Controller;
use App\Models\Actor\User;
use App\Models\Broadcast\Attendance;
use Illuminate\Http\Request;
use App\Models\Advisory;
use Carbon\Carbon;
use App\Classes\SetPort;
use Response;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
        {
            $attendances = Attendance::with('checkby', 'user')->orderBy('updated_at','desc')
                ->get();
            return Response::json($attendances);
        }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function find(Attendance $attendance){
        return Response::json($attendance);
    }

    public function store(Request $request)
        {
            $attendance = Attendance::updateOrCreate(['id' => $request->id],
                [
                    'user_id' => $request->user_id,
                    'section' => $request->mname,
                    'lname' => $request->lname,
                    'DOB' => $request->DOB,
                    'phone' => $request->phone,
                    'gender' => $request->gender,
                    'email' => $request->email,
                ]
            );
            $state = $attendance->wasRecentlyCreated ? 201 : 200;
            return response()->json($attendance, $state);
        }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Actor\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
        {
            return Response::json($attendance);
        }
    public function update(Request $request, Attendance $attendance)
        {
            return $attendance;
            $attendance->update([
                'remarks' => $request->remarks,
                'check_by' => $request->check_by,
            ]);
            return response()->json('success', 200);
        }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Actor\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
        {
            $attendance->delete();
            return response()->json(null, 204);
        }
    public function msgReceived(Request $request, Attendance $attendance)
        {
            $tap = null;
            switch ($request->positionTap) {
                case 'am_in':
                    $tap = 'txt_am_in';
                    break;
                case 'am_out':
                    $tap = 'txt_am_out';
                    break;
                case 'pm_in':
                    $tap = 'txt_pm_in';
                    break;
                case 'pm_out':
                    $tap = 'txt_pm_out';
                    break;
                case 'am_absent':
                    $tap = 'am_absent';
                    break;
                default:
                    $tap = 'pm_absent';
            }

            $attendance->update([
                $tap => now(),
            ]);

            return response()->json('success', 200);
        }

    public function presents(Request $request)
        {
            // return $request;
            $gender=$request->gender;
            $logon=$request->logon;
                if($request->status==0){
                    $total = Advisory::with('student')
                        ->whereLevelId($request->key)
                        ->whereHas('student', function ($student) use($gender) {
                            if($gender==0){
                                $student->whereIsMale(0);
                            }else if($gender==1){
                                $student->whereIsMale(1);
                            }
                        })
                        ->whereDoesntHave('attendances', function ($attendances) use($logon) {
                                $attendances->whereDate('created_at',  $logon); //"2019-10-01");
                            })
                        ->get();
                    }else if($request->status==1){
                        $total = Advisory::with('student')
                            ->whereLevelId($request->key)
                            ->whereHas('student', function ($student) use($gender) {
                                if($gender==0){
                                    $student->whereIsMale(0);
                                }else if($gender==1){
                                    $student->whereIsMale(1);
                                }
                            })
                            ->whereHas('attendances', function ($attendances) use($logon){
                                $attendances->whereDate('created_at', $logon); //"2019-10-01"
                            })
                            ->get();
                    }else{
                        $total = Advisory::with('student')
                        ->whereLevelId($request->key)
                        ->whereHas('student', function ($student) use($gender) {
                            if($gender==0){
                                $student->whereIsMale(0);
                            }else if($gender==1){
                                $student->whereIsMale(1);
                            }
                        })
                        ->get();
                    }
            return $total;
        } 
    
    public function checkports()
        {
            $port=new SetPort(); 
            return $port->activePort;
        }
        
}
