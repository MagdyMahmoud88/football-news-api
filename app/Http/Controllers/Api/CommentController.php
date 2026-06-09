<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\News;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, News $news)
    {
        $data = $request->validate(['body' => 'required|string|max:1000']);

        $comment = $news->comments()->create([
            'user_id' => $request->user()->id,
            'body'    => $data['body'],
        ]);

        return response()->json($comment->load('user'), 201);
    }

    public function destroy(Request $request, Comment $comment)
    {
        if ($request->user()->id !== $comment->user_id && !$request->user()->is_admin) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $comment->delete();
        return response()->json(['message' => 'تم حذف التعليق']);
    }
}
