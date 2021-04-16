<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Response, File;

class CompanyController extends Controller
{
    public function indexU(Request $request)
        {   
            $companies=Company::where(function ($q){
                                    $q->where('name', 'like', '%'.\Request::get('key').'%')
                                    ->orWhere('subname', 'like', '%'.\Request::get('key').'%');
                                })
                             ->whereApprove(1)
                                
                            ->orderBy('name', 'asc')
                            ->limit(8)
                            ->get();
            return response()->json($companies);  
             
        }
    public function indexA(Request $request)
        {   
            $companies=Company::where(function ($q){
                                    $q->where('name', 'like', '%'.\Request::get('key').'%')
                                    ->orWhere('subname', 'like', '%'.\Request::get('key').'%');
                                })
                             ->whereNull('approve')
                                
                            ->orderBy('name', 'asc')
                            ->limit(8)
                            ->get();
            return response()->json($companies);  
             
        }
    public function list()
        {
            $companies=Company::all();
            return response()->json($companies);  
        }
    public function save(Request $request)  
        {
            // return $request;
            $path=public_path("/images/company/");
            if(!File::isDirectory($path)){ File::makeDirectory($path, 0777, true, true); }

            $filename = $request->name.'.jpeg';
            $encoded_file=$request->logo;
            $file = str_replace('data:image/jpeg;base64,', '', $encoded_file);
            $file = str_replace(' ', '+', $file);
            $decode_file   = base64_decode($file);

            if (file_exists("{$path}{$filename}"))  
            { 
                unlink("{$path}{$filename}");
            }

            file_put_contents("{$path}{$filename}", $decode_file);
          

            $company=Company::updateOrCreate(
            [
                'name' => $request->name,
                'subname' => $request->subname
            ],[
                'logo' => $request->logo?$filename:null,
                'street' => $request->street,
                'purok' => $request->purok,
                'brgy' => $request->brgy,
                'phone' => $request->phone,
            ]);
            return Response::json($company, 201);
        }

    public function imageTransfer(Request $request)
        {   

            if ($file = $request->file('file')) {
                //set filename
               $filename = $request->name . ' ' . $request->subname . '.' . $file->getClientOriginalExtension();
               //set folder path
               $path = 'app/public/images/company/';
               //move image to folder path(first parameter) and rename the file (second parameter)
               $file->move(storage_path($path), $filename);
            }
           
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
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
        {
            //
        }   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)  
        {
            //
        }   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
        {
            // return $request;
            $company->update([                
                'approve'     => $request->approve,      
                'reason'     => $request->reason,          
            ]);
            return Response::json($company, 201);     
        }
    function find($company)
        { 
            $company=User::find($company);
            return Response::json($company);
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
        {
            //
        }   
}
