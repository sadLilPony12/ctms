<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Broadcast\attendance;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        
        'profile_picture',
        'name',
        'email',
        'password',
        'role_id',
        'fname',
        'mname',
        'lname',
        'suffix',
        'is_male',
        'dob',
        'addR',
        'addP',
        'addC',
        'addB',
        'addPr',
        'addH',
        'phone',
        
        'deleted_at',
        'reason',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
     
    protected $appends = [
        'is_admin',
        'citizen_code',
        'address',
        'fullname',
    ];

    public function getIsAdminAttribute(){
        if ($this->role_id == 2 || $this->role_id == 1){
            return true;
        }
        return false;
    }
    public function getCitizenCodeAttribute()
        {
            if($this->item){
                $initname = ucfirst($this->fname[0]);    
                $lcode = ucfirst($this->lname[0]);   
                $pcode = str_pad($this->id, 8, '0', STR_PAD_LEFT);
                $brgy = str_pad($this->item->brgy, 5, '0', STR_PAD_LEFT);
                return "{$initname}{$lcode}-{$brgy}-{$pcode}";
            }else{
                return null;
            }
        }
    public function getAddressAttribute()
        {
          return $this->item?"{$this->item->num}, {$this->item->street}, {$this->item->purok}, {$this->item->brgy}":null;
        }
    public function getFullnameAttribute()
        {
            $ln=$this->lastname?$this->lname->name:'';
            $fn = $ln==''?$this->fname :"{$this->fname} {$ln}";
            if($this->mname)  {
                $fn = "{$this->fname} {$this->mname} {$ln}";
                }
            if($this->suffix != null){
                $fn .=", {$this->suffix}";
            }
            return  strtoupper($fn);
        }
    
    public function item(){return $this->hasOne(UserItem::class);}
    public function attendance(){return $this->hasOne(Attendance::class);}
    
    public function company(){return $this->hasOne(Company::class);}
    public function role(){return $this->belongsTo(Role::class);}
    
}
