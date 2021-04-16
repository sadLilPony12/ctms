<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', //0926-136-4720
        'company_id', 
        'phone', //0926-136-4720
        'num', // 25
        'street', // papaya road
        'purok', // purok 2
        'brgy', // mabini extension
        'town', // cab
        'province', // nueva ecija
        'region', // 03 
        'user_id' // 03 
    ];

    protected $casts = [
        'user_id'    => 'integer',
        'company_id'    => 'integer',
    ];
    protected $appends = [
        'fullname',
        'has_company',
        ];

    public function getFullnameAttribute()
        {
            return $this->company?$this->company->fullname:null;
        }
    public function getHasCompanyAttribute()
        {
            return $this->company_id?$this->company_id:null;
        }
    public function user(){return $this->belongsTo(User::class);}
    public function company(){return $this->belongsTo(Company::class);}
}
