<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductReview;
use Illuminate\Support\Facades\Validator;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'comment' => 'nullable|string|max:255',
            'product_id' => 'required|exists:products,id',
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
}
