<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Response, File;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles=Article::whereNull('deleted_at')->get();
        return response()->json($articles);
    }

    public function save(Request $request)  
        { 
            $path=public_path("/images/article/".date('Y')."/".date('F')."/");
            // return $path;
            if(!File::isDirectory($path)){ File::makeDirectory($path, 0777, true, true); }

            $filename = $request->title.'.jpeg';
            $encoded_file=$request->logo;
            $file = str_replace('data:image/jpeg;base64,', '', $encoded_file);
            $file = str_replace(' ', '+', $file);
            $decode_file   = base64_decode($file);

            if (file_exists("{$path}{$filename}"))  
            { 
                unlink("{$path}{$filename}");
            }

            file_put_contents("{$path}{$filename}", $decode_file);
          


            $news=Article::create([
                'avatar' => $request->logo?$filename:null,
                'title' => $request->title,
                'message' => $request->message,
                'reference'=>$request->reference,
                'start_at' => $request->start_at,
                'end_at' => $request->end_at,
                'user_id' => $request->user_id,
            ]);
            return Response::json($news, 201); 
        }

    public function imageTransfer(Request $request)
        {   

            if ($file = $request->file('file')) {
                //set filename
               $filename = $request->title . '.' . $file->getClientOriginalExtension();
               //set folder path
               $path = 'app/public/images/newsflash/Do and Dont/';
               //move image to folder path(first parameter) and rename the file (second parameter)
               $file->move(storage_path($path), $filename);
            }
           
        }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }
}
