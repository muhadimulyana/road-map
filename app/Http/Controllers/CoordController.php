<?php

namespace App\Http\Controllers;

use App\Models\Coord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Image;

class CoordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $keys = DB::table('key_api')->where('aktif', 1)->get();
        $jenis_usaha = DB::table('m_jenis_usaha')->get();
        $jenis_bahan = DB::table('m_jenis_bahan')->get();
        $tempat_penjualan = DB::table('m_tempat_penjualan')->get();
        $jenis_pembayaran = DB::table('m_jenis_pembayaran')->get();
        $mesin = DB::table('m_mesin')->get();

        foreach($keys as $row){
            $request = Http::get('https://api.maptiler.com/maps/streets/tiles.json?key=' . $row->key);
            if($request->successful()){
                $key = $row->key;
                break;
            } else {
                DB::table('key_api')->where('key', $row->key)->update(['aktif' => 0]);
            }
        }

        return view('app')->with('key', $key)->with('jenis_usaha', $jenis_usaha)->with('jenis_bahan', $jenis_bahan)->with('jenis_pembayaran', $jenis_pembayaran)->with('tempat_penjualan', $tempat_penjualan)->with('mesin', $mesin)->with('i', 0);
    }
    //
    public function getCoordinates(Request $request)
    {
        $coords = Coord::all();
        return response()->json($coords, 200, []);

    }

    public function getApiKey()
    {
        $result = DB::table('key_api')->where('aktif', 1)->get();

        foreach($result as $row){
            $request = Http::get('https://api.maptiler.com/maps/streets/tiles.json?key=' . $row->key);
            if($request->successful()){
                $response = [
                    'key' => $row->key
                ];
                break;
            } else {
                DB::table('key_api')->where('key', $row->key)->update(['aktif' => 0]);
            }
        }

        return response()->json($response, 200, []);

    }

    public function checkApi()
    {
        $request = Http::get('https://api.maptiler.com/maps/streets/tiles.json?key=UyiGFyFAZELpBWUZ6VQd');
        if( $request->successful() ) {
            
            return response()->json($request, 200, []);
        }
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
                $img = Image::make($file->getRealPath());
                $img->resize(100, 100, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path() . '/upload/img/thumbnail/' . $name);
                $file->move(public_path() . '/upload/img/', $name);
                //$path = Storage::putFileAs('public/images', $file, $name);
                $files[] = [
                    'id' => $data['id'],
                    'gambar' => $name,
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
                'code' => 200,
            ];
            DB::commit();

        } catch (QueryException $e) {

            $response[] = [
                'message' => 'Error: ' . '[' . $e->errorInfo[1] . '] ' . $e->errorInfo[2],
                'code' => 500,
            ];
            DB::rollback();

        }

        return response()->json($response, $response[0]['code'], []);

    }

    public function getMarkerImage(Request $request)
    {
        $id = $request->input('id');
        $image = DB::table('gps_markers_gambar')->where('id', $id)->get();
        return response()->json($image, 200, []);
    }
}
