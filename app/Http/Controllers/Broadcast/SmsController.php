<?php

namespace App\Http\Controllers\Broadcast;

use App\Http\Controllers\Controller;
use App\Jobs\SMSBlast;
use App\Models\Actor\User;
use App\Models\Actor\Level;
use App\Models\Advisory;
use App\Models\MessageLog;
use App\Models\Setting;
use App\Classes\ConfirmPort;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    /**
     * synchronize message
     */
    public function smsNotification(Request $request)
        {
            error_reporting(E_ALL);
            $setting = Setting::first();

            //For Globe Tatoo GSM Modem or the like
            $phone = $request->phone;
            $message = $request->message;
           
            $log = MessageLog::create([
                'message' => $message,
                'phone' => $phone,
            ]);

            return response()->json('successfully save');
        }

    public function sendAllSMS(Request $request)
        {
            ini_set('max_execution_time', '5000');

            $message = $request['message'];
            $contacts = User::whereRole('student')->get();

            foreach ($contacts as $key => $contact) {
                $job = (new SMSBlast($contact->guardian_number, $message))->delay(Carbon::now()->addSeconds(5));
                dispatch($job);
            }

            Session::flash('success', 'Message is sending in the background. You can continue working while we send your messages');
            return redirect()->back();
        }

    public function sendByYear(Request $request)
        {
            $message = $request['message'];
            $contacts = User::whereRole('student')
                ->WhereHas('level', function ($l) {
                    $l->whereCourse('JHS')->whereLevel(7);
                })
                ->get();

            foreach ($contacts as $key => $contact) {
                $job = (new SMSBlast($contact->guardian_number, $message))->delay(Carbon::now()->addSeconds(5));
                dispatch($job);
            }

            Session::flash('success', 'Message is sending in the background. You can continue working while we send your messages');
            return redirect()->back();
        }

    public function sendBySection(Request $request)
        {
            $message = $request['message'];
            $contacts = User::whereRole('student')
                ->WhereHas('level', function ($l) {
                    $l->whereCourse('JHS')
                        ->whereLevel(7)
                        ->whereSection('avocado');
                })
                ->get();

            foreach ($contacts as $key => $contact) {
                $job = (new SMSBlast($contact->guardian_number, $message))->delay(Carbon::now()->addSeconds(5));
                dispatch($job);
            }

            Session::flash('success', 'Message is sending in the background. You can continue working while we send your messages');
            return redirect()->back();
        }

    public function SMSBlaster()
        {
            ini_set('max_execution_time', '300');

            $arr = ['09256014093', '09350339777'];

            for ($i = 0; $i < 50; $i++) {
                foreach ($arr as $key => $num) {
                    $number = $arr[$key];
                    $job = (new SMSBlast($number))->delay(5);
                    dispatch($job);
                }
            }
        }
    public function InfoMessage(){
        $advisories=Advisory::whereHas('guardian', function ($att){
                                $att->whereNotNull("phone")
                                ->whereRaw('LENGTH(phone) = 11');
                            })
                            ->whereHas('level', function ($level){
                                $level->whereBatchId(2);
                            })
                            ->get();
           
            foreach($advisories as $key=>$advisory){
                    $phone=$advisory->guardian->phone;                
                        $message = "your number is registered to receive a daily notification from BICOS NHS, ".
                        "for more information, feel free to contact your protege's Adviser.".
                        "This is an electronic generated message, do not reply.";

                        MessageLog::create([
                            'message' => $message,
                            'phone' => $phone,
                        ]);
            }
            return "Success";
        }
    public function confirmPort(){
        $setport = new ConfirmPort();
        $setport->init();
        return "<br>check your console";
    }
}
// https://www.tecmint.com/best-open-source-bulk-sms-gateway-software/
