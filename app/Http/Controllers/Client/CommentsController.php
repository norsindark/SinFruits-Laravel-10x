<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use Illuminate\Http\Request;
use App\Models\ProductReview;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CommentsController extends Controller
{
    public function store(CommentRequest  $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'comment' => [
                'nullable',
                'string',
                'max:255',
                Rule::notIn(config('app.forbidden_words')),
            ],
            'rating' => 'nullable|integer|between:1,5',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [
            'user_id' => auth()->id(),
            'product_id' => $request->input('product_id'),
        ];



        if ($request->filled('comment')) {
            $data['comment'] = $request->input('comment');
        }

        if ($request->filled('rating')) {
            $data['rating'] = $request->input('rating');
        }

        ProductReview::create($data);

        return redirect()->back()->with('success', 'Comment and rating added successfully');
    }

    public function storeReplyComment(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'parent_id' => 'required|exists:product_reviews,id',
            'product_id' => 'required|exists:products,id',
            'comment' => [
                'nullable',
                'string',
                'max:255',
                Rule::notIn(config('app.forbidden_words')),
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [
            'user_id' => auth()->id(),
            'parent_id' => $request->input('parent_id'),
            'product_id' => $request->input('product_id'),
            'comment' => $request->input('comment'),
        ];

        ProductReview::create($data);

        return redirect()->back()->with('success', 'Reply added successfully');
    }
}
