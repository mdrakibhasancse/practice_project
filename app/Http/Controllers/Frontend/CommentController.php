<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function comment(Request $request)
    {
        $request->validate([
            'comment' => 'required|string|max:500',
        ]);

        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Authentication required.'], 403);
        }

        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->commentable_id = $request->id;
        $comment->commentable_type = Post::class;
        $comment->body = $request->comment;
        $comment->save();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'page' => view('frontend.post.ajax.comment', ['comment' => $comment])->render()
            ]);
        }
        return redirect()->back();
    }


    public function comments(Request $request, Post $post)
    {
        $postComments = $post->paginatedComments;
        $nextPageUrl = $postComments->nextPageUrl() ?: null;
        if ($request->ajax()) {
            return response()->json([
                'page' => view('frontend.post.ajax.postComments', ['post'=> $post, 'comments'=> $postComments])->render(),
                'success'=> true,
                'nextPageUrl' => $nextPageUrl
            ]);
        }
    }
}
