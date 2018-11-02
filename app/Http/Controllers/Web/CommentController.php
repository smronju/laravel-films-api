<?php

namespace App\Http\Controllers\Web;

use App\Comment;
use App\Http\Requests\StoreComment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(StoreComment $request) {
        $newComment = new Comment();

        $newComment->fill($request->all());
        $newComment->user_id = Auth::user()->id;
        $newComment->film_id = $request->film_id;
        $newComment->save();

        return back();
    }
}
