<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    private $pagination_number;

    public function __construct()
    {
        $this->pagination_number = 2;
    }

    public function index()
    {
        $reviews = Review::paginate($this->pagination_number);
        return view('index', ['reviews' => $reviews]);
    }

    public function store(ReviewRequest $request)
    {
        $review = Review::create($request->all());
        $pagination = Review::count() <= $this->pagination_number;

        if ($request->file('images')) {
            $images = [];
            $i = 1;

            foreach ($request->file('images') as $image) {
                $file_name = now() . '_' . $i++ . '.' . $image->getClientOriginalExtension();
                $file_path = 'images/reviews/' . $file_name;
                $image->storeAs($file_path);
                $images[] = $file_path;
            }

            $review->images = $images;
            $review->save();
        }

        return response()->json(['review' => $review, 'pagination' => $pagination], 201);
    }
}
