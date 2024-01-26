<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = ProductReview::paginate(12);
        return view('dashboard.pages.comments.index', compact('comments'));
    }

    public function removeComment($commentId)
    {
        $comment = ProductReview::find($commentId);
        if (!$comment) {
            return redirect()->back()->with('error', 'Comment not found!');
        }
        $comment->status = 1;
        $comment->save();

        return redirect()->back()->with('success', 'Remove commnet successfully!');
    }
}
