<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Shop;

class ShopController extends Controller
{
    public function create()
    {
        $areas = Area::all();
        $genres = Genre::all();

        return view('owner.create', compact('areas', 'genres'));
    }

    public function store(Request $request)
    {
        $dir = 'images';

        $file = $request->file('shop__image');
        $file_name = $file->getClientOriginalName();
        $request->file('shop__image')->storeAs('public/' . $dir, $file_name);

        $image = 'storage/' . $dir . '/' . $file_name;
        
        Shop::create([
            'user_id' => Auth::id(),
            'area_id' => $request->area_id,
            'genre_id' => $request->genre_id,
            'name' => $request->name,
            'image' => $image,
            'description' => $request->description,
        ]);

        return redirect('/owner/shop/list');
    }

    public function list(Request $request)
    {
        $query = Shop::with(['area', 'genre', 'likedByUsers']);

        if ($request->filled('keyword')) {
            $query->keywordSearch($request->keyword);
        }

        $shops = $query->where('user_id', Auth::id())->get();

        return view('owner.list', compact('shops'));
    }
}
