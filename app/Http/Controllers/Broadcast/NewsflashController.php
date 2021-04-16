<?php

namespace App\Http\Controllers\Broadcast;

use App\Http\Controllers\Controller;
use App\Models\Actor\Article;
use Illuminate\Http\Request;
use Response;

class NewsflashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
        {
            $article = Article::with('reporter')->latest()->get();
            return Response::json($article);
        }
    public function broadcast()
        {
            $article = Article::where('start_at', '<', now())
                ->where('end_at', '>', now())
                ->latest()->get();
            return Response::json($article);
        }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
        {
            // if($request->hasFile('avatar')){
            //     $image = $request->file('avatar');
            //     $filename = $request->title.'-' . date('FY').'.'.$image->getClientOriginalExtension();
            //     $image->move(public_path("/storage/articles/" . date('FY'). '/'), $filename);

            //     $request->avatar = $filename;
            //   };

            $article = Article::Create([
                'avatar' => $request->avatar,
                'title' => $request->title,
                'message' => $request->message,
                'start_at' => $request->start,
                'end_at' => $request->end,
                'user_id' => $request->user_id,
            ]);
            $state = $article->wasRecentlyCreated ? 201 : 200;
            return response()->json($article, $state);
        }

    public function update(Request $request, $id)
        {
            if ($request->hasFile('avatar')) {
                $image = $request->file('avatar');
                $filename = $request->title . '-' . date('FY') . '.' . $image->getClientOriginalExtension();
                $image->move(public_path("/storage/articles/" . date('FY') . '/'), $filename);

                $request->avatar = $filename;
            };
            $article = Article::find($id);
            $article->update([
                'avatar' => $request->avatar,
                'title' => $request->title,
                'message' => $request->message,
                'start_at' => $request->start,
                'end_at' => $request->end,
                'user_id' => $request->user_id,
            ]);
            $state = $article->wasRecentlyCreated ? 201 : 200;
            return response()->json($article, $state);
        }
    public function edit($id)
        {
            $article = Article::find($id);
            return Response::json($article);
        }

    public function destroy($id)
        {
            $article = Article::find($id);
            $article->delete();
            return response()->json(null, 204);
        }
}
