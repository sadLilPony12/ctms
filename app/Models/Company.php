<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'subname',
        'street',
        'purok',
        'brgy',
        'phone',
        'logo',
        'approve',
        'reason'
    ];
    protected $appends = [
        'address',
        'fullname',
        ];

    public function getAddressAttribute()
        {
          return "#{$this->num} {$this->street}, {$this->purok}, {$this->brgy}";
        }
    public function getFullnameAttribute()
        {
           return "{$this->name} {$this->subname}";
        }

}

