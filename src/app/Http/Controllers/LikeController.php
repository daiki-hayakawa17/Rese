<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;

class LikeController extends Controller
{
    public function like($shop_id)
    {
        $user_id = Auth::id();

        $alreadyLiked = Like::where('shop_id', $shop_id)->where('user_id', $user_id)->exists();

        if (!$alreadyLiked) {
            Like::create([
                'shop_id' => $shop_id,
                'user_id' => $user_id,
            ]);
        }

        return redirect('/');
    }

    public function unlike($shop_id)
    {
        $user_id = Auth::id();

        $like = Like::where('shop_id', $shop_id)->where('user_id', $user_id)->first();
        $like->delete();

        return redirect('/');
    }
}
