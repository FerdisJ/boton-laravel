<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Counter;

class LandingController extends Controller
{
    public function index()
    {
        $counters = Counter::latest()->take(10)->get();

        return view('landing', [
            'counters' => $counters
        ]);
    }

    public function store(Request $request)
    {
        $counter = Counter::create([
            'value' => $request->value
        ]);

        return response()->json($counter);
    }
}
