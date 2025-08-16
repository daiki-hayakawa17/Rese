<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;

class ShopListController extends Controller
{
    public function shopListView(Request $request)
    {
        $query = Shop::with(['area', 'genre']);

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

    public function thanksView()
    {
        return view('auth.thanks');
    }
}
