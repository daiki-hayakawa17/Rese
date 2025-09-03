<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\Review;

class ReviewController extends Controller
{
    public function createView($shop_id)
    {
        $shop = Shop::with(['area', 'genre'])->find($shop_id);

        return view('review', compact('shop'));
    }

    public function store($shop_id, Request $request)
    {
        $user = Auth::user();

        Review::create([
            'shop_id' => $shop_id,
            'user_id' => $user->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect('/');
    }
}
