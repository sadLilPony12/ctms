<?php

namespace App\Http\Controllers\Broadcast;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Advisory;
use App\Models\Broadcast\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Response;

class DTRController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
        {
            $attendance = Attendance::with('user')
                ->whereDate('created_at', Carbon::today())
                ->orderBy('updated_at','desc')
                ->limit(20)->get();
            return Response::json($attendance);
        }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function find(Request $request, $code)
        {
            if (User::whereId($code)->exists()) {
                $tap= null;
                $tap['time'] = Carbon::now()->format('H:i:s');
                $tap['station'] = (int)$request->station;

                $attendance = Attendance::with('user')
                    ->whereHas('user', function ($user) use($code){
                        $user->whereId($code);
                    })
                    ->whereDate('created_at', Carbon::today())
                    ->whereNull('deleted_at')
                    ->first();

                    if($attendance){
                            $oldTap=$attendance->tap;
                            array_push($oldTap, $tap);
                            $saved=$attendance->update(['tap'=>$oldTap]);
                            return Response::json(['dtr' => $attendance->fresh(['user'])]);

                        // $d = Carbon::parse($attendance->punch->time);
                        // if($d->diffInMinutes(Carbon::now()->format('H:i:s'))<5){
                        //     return Response::json(['warning' => true, 'dtr' => $attendance]);
                        // }else{
                        //     $oldTap=$attendance->tap;
                        //     array_push($oldTap, $tap);
                        //     $saved=$attendance->update(['tap'=>$oldTap]);
                        //     return Response::json(['dtr' => $attendance->fresh(['user'])]);
                        // }
                    }else{
                        $user=User::whereId($code)->first();
                        $attendance=$user->attendance()->save(new Attendance(['tap'=>collect([$tap])]));
                        return Response::json(['dtr' => $attendance->fresh(['user'])]);
                    }
            } else {
                return Response::json(['Unregistered' => true, 'warning' => 'Unregistered code!, Please contact the admin for more information.']);
            }
        }

    //Notify absent
    public function is_absent(Attendance $attendance)
        {
            /*
            *   Check status of absent
            *   1. Sat/Sun ***
            *   2. No classes ***
            *   3. AM absent
            *   4. whole day absent
            */
            $students = Advisory::whereDoesntHave('attendances', function ($attendances) {
                    $attendances->whereDate('created_at', Carbon::today());
                })
                ->WhereDoesntHave('attendances', function ($attendances) {
                    $attendances->whereDate('created_at', Carbon::today())
                        ->WhereNotNull('am_absent');
                })
                ->get();
            return Response::json($students);
        }
}
