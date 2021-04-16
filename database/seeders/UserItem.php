<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserItem extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_items')->insert([
            [
                'user_id'   =>1,
                'company_id'=>NULL,
                'num'       =>'29',
                'brgy'      =>'IV',
                'street'    =>NULL,
                'purok'     =>'mabini',
                'phone'     =>'(966) 697-4691',
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),

            ],
            [
                'user_id'   =>2,
                'company_id'=>NULL,
                'num'       =>'Block 12, Lot 23',
                'brgy'      =>'Valle Cruz',
                'street'    =>NULL,
                'purok'     =>'Paros',
                'phone'     =>'(966) 697-4691',
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),

            ],
            [
                'user_id'   =>3,
                'company_id'=>NULL,
                'num'       =>'68',
                'brgy'      =>'Casile',
                'street'    =>NULL,
                'purok'     =>'Sumilang',
                'phone'     =>'(930) 385-2397',
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),

            ],
            [
                'user_id'   =>4,
                'company_id'=>NULL,
                'num'       =>'spo-560',
                'brgy'      =>'San Pedro',
                'street'    =>NULL,
                'purok'     =>'Gulod',
                'phone'     =>'(927) 013-2914',
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),

            ],
            [
                'user_id'   =>5,
                'company_id'=>NULL,
                'num'       =>'33',
                'brgy'      =>'West Poblacion',
                'street'    =>NULL,
                'purok'     =>'3',
                'phone'     =>'(961) 191-5771',
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),

            ],
            [
                'user_id'   =>6,
                'company_id'=>NULL,
                'num'       =>NULL,
                'brgy'      =>'San Anton',
                'street'    =>NULL,
                'purok'     =>'3',
                'phone'     =>'(936) 663-8452',
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),

            ],
            [
                'user_id'   =>7,
                'company_id'=>NULL,
                'num'       =>NULL,
                'brgy'      =>'Bangad',
                'street'    =>NULL,
                'purok'     =>'3',
                'phone'     =>'(916) 244-3346',
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>Carbon::now()->format('Y-m-d H:i:s'),

            ],
        ]);
    }
}
