<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCommentRequest;
use App\Models\Comment;

class CommentsController extends Controller
{
    public function store(CreateCommentRequest $request)
    {
        Comment::create($request->validated());

        return redirect()->back();
    }
}
