<?php

namespace App\Models\Broadcast;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Broadcast\Attendance;


class Attendance extends Model
{
    protected $fillable = [
        'user_id',
        'tap',
        'check_by',
        'terminal',
        'remarks',
        
    ];
     protected $casts = [
         'tap' => 'object',
         'created_at'=>'date:M d, Y'
     ];
    protected $appends = [
        'punch',
        'position',
        // 'brgy',
        'fullname'
    ];

    public function getPunchAttribute(){ return last($this->tap);}
    public function getPositionAttribute(){ return count($this->tap)%2?'In':'Out';}
    public function getFullnameAttribute(){
        return $this->user->fullname;
    }

    //Relationship
    public function user(){return $this->belongsTo(User::class,'user_id');}
    public function checkby(){return $this->belongsTo(User::class, 'check_by');}
}
