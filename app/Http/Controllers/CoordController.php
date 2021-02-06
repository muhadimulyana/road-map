<?php

namespace App\Http\Controllers;

use App\Models\Coord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CoordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
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
            'id' => time(),
            'place' => $request->place,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'user' => 'mamulyana',
            'created_date' => date('Y-m-d H:i:s'),
        ];

        $files = false;
        $i = 1;
        if ($request->hasfile('file')) {
            foreach ($request->file('file') as $file) {
                $name = time() . '_' . $i . '.' . $file->extension();
                $file->move(public_path() . '/upload/img/', $name);
                $files[] = [
                    'id' => $data['id'],
                    'gambar' => $name
                ];
                $i++;
            }
        }

        DB::beginTransaction();

        try {

            Coord::create($data);
            ($files) ? DB::table('gps_markers_gambar')->insert($files) : '';
    
            $response[] = [
                'id' => $data['id'],
                'place' => $request->place,
                'lat' => $request->lat,
                'lng' => $request->lng,
                'file' => ($files) ? array_column($files, 'gambar') : null,
                'code' => 200
            ];
            DB::commit();

        } catch(QueryException $e) {

            $response[] = [
                'message' => 'Error: ' . '[' . $e->errorInfo[1] . '] ' . $e->errorInfo[2],
                'code' => 500
            ];
            DB::rollback();

        }

        return response()->json($response, $response[0]['code'], []);

    }
    

    public function getMarkerImage(Request $request)
    {
        $id = $request->input('id');
        //dd($id);
        $image = DB::table('gps_markers_gambar')->where('id', $id)->get();
        //dd($image);
        return response()->json($image, 200, []);
    }
}
