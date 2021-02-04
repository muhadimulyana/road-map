<?php

namespace App\Http\Controllers;

use App\Models\Coord;
use Illuminate\Http\Request;

//use Illuminate\Support\Facades\DB;

class CoordController extends Controller
{
    //
    public function getCoordinates(Request $request)
    {
        $coords = Coord::all();
        return response()->json($coords, 200, []);

    }

    public function store(Request $request)
    {
        $request->validate([
            'place' => 'required',
            'lat' => 'required',
            'lng' => 'required',
        ]);

        $data = [
            'id' => $request->lat . '_' . $request->lng,
            'place' => $request->place,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'user' => 'mamulyana',
            'created_date' => date('Y-m-d H:i:s'),
        ];

        Coord::create($data);

        $response[] = [
            'place' => $request->place,
            'lat' => $request->lat,
            'lng' => $request->lng,
        ];

        return response()->json($response, 200, []);

    }
}
