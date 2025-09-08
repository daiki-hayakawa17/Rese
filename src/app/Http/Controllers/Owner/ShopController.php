<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Genre;

class ShopController extends Controller
{
    public function create()
    {
        $areas = Area::all();
        $genres = Genre::all();

        return view('owner.create', compact('areas', 'genres'));
    }
}
