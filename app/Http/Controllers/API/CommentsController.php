<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\RateRequest;
use App\Http\Resources\CommentResource;
use App\Http\Resources\RateResource;
use App\Models\Comments;
use Illuminate\Http\Request;


class CommentsController extends Controller
{


    public function __construct()
    {
        //  $this->middleware('jwt.verify')->only(['index','store','update','show','destroy']);
    }


    public function store(CommentRequest $request){

        $comment= Comments::create([
            'vaila_id' => $request->vaila_id,
            'body' => $request->body,
            'user_id'=> auth('api-jwt')->user()->id
        ]);
        return new CommentResource($comment);
    }


    public function show(Comments $comment){
        return new RateResource($comment);
    }

    public function update(Comments $comment,RateRequest $request){

        $comment= tap($comment)->update($request->all());

        return new CommentResource($comment);
    }


    public function destroy(Comments $comment){
        $comment->delete();
        return Response('',201);
    }





}
