<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Like;

class ShopListController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $query = Shop::with(['area', 'genre', 'likedByUsers']);

        if ($request->filled('area_id')) {
            $query->where('area_id', $request->area_id);
        }

        if ($request->filled('genre_id')) {
            $query->where('genre_id', $request->genre_id);
        }

        if ($request->filled('keyword')) {
            $query->keywordSearch($request->keyword);
        }

        $shops = $query->get();

        $areas = Area::all();
        $genres = Genre::all();

        return view('list', compact('shops', 'areas', 'genres'));
    }
}
