<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::paginate(10);
        return view('index', ['reviews' => $reviews]);
    }

    public function store(ReviewRequest $request)
    {
        $review = Review::create($request->all());
        return response()->json($review, 201);
//        $reviews = Review::paginate(10);
//        return view('index', ['reviews' => $reviews]);
    }
}
