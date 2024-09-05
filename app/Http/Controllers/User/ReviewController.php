<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller {
    public function index() {
        $pageTitle = 'All Reviews';
        $reviews   = Review::where('user_id', auth()->id())->with('rental', 'vehicle')->searchable(['rental:rent_no'])->orderBy('id', 'desc')->paginate(getPaginate());
        return view($this->activeTemplate . 'user.review.index', compact('pageTitle', 'reviews'));
    }

    public function form($rentalId = 0, $id = 0) {
        $rental = Rental::completed()->findOrFail($rentalId);

        if ($rental->review && $id == 0) {
            $notify[] = ['error', 'Already reviewed this vehicle'];
            return back()->withNotify($notify);
        }

        $pageTitle = 'Review for - ' . @$rental->vehicle->name;
        return view($this->activeTemplate . 'user.review.form', compact('pageTitle', 'rental'));
    }

    public function add(Request $request, $rentalId, $id = 0) {
        $rental = Rental::where('user_id', auth()->id())->completed()->findOrFail($rentalId);
        if ($rental->review && !$id) {
            $notify[] = ['error', 'Already reviewed this influencer'];
            return back()->withNotify($notify);
        }
        $request->validate([
            'star'   => 'required|integer|min:1|max:5',
            'review' => 'required|string',
        ]);
        if ($id) {
            $review = $rental->review;
        } else {
            $review = new Review();
        }
        $this->insertReview($review, $rental);
        $this->vehicleReviewUpdate($rental->vehicle);

        $notify[] = ['success', 'Review added successfully'];
        return to_route('user.review.index')->withNotify($notify);
    }

    protected function insertReview($review, $rental) {
        $request            = request();
        $review->user_id    = auth()->id();
        $review->rental_id  = $rental->id;
        $review->vehicle_id = $rental->vehicle_id;
        $review->star       = $request->star;
        $review->review     = $request->review;
        $review->save();
    }

    public function remove($id) {
        $review  = Review::where('user_id', auth()->id())->findOrFail($id);
        $vehicle = $review->vehicle;
        $review->delete();

        $this->vehicleReviewUpdate($vehicle);

        $notify[] = ['success', 'Review removed successfully'];
        return back()->withNotify($notify);
    }
    protected function vehicleReviewUpdate($vehicle) {
        $totalStar   = $vehicle->reviewData->sum('star');
        $totalReview = $vehicle->reviewData->count();

        if ($totalReview != 0) {
            $avgRating = $totalStar / $totalReview;
        } else {
            $avgRating = request()->star ?? 0;
        }
        $vehicle->rating = $avgRating;
        $vehicle->save();
    }
}
