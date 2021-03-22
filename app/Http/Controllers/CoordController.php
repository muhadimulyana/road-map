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
        $coords = DB::table('tempat')->get();
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
        
        $data = [
            'ID_TEMPAT' => time(),
            'KATEGORI' => $request->kategori,
            'NAMA_USAHA' => $request->nama_usaha,
            'CP' => $request->cp,
            'TELEPON' => $request->telepon,
            'ALAMAT' => $request->alamat,
            'STATUS_USAHA' => $request->status_tempat,
            'JUMLAH_PEKERJA' => $request->jml_pekerja,
            'PROSES_PENJUALAN' => $request->proses_penjualan,
            'PROSES_PEMBAYARAN' => $request->proses_pembayaran,
            'LAT' => $request->lat,
            'LNG' => $request->lng,
            'TANGGAL_KUNJUNGAN' => $request->tgl_kunjungan,
            'TANGGAL_BUAT' => date('Y-m-d H:i:s'),
            'USERNAME' => 'mamulyana'
        ];

        // jenis usaha
        foreach($request->jenis_usaha as $key => $value) {
            $jenis_usaha[] = [
                'ID_TEMPAT' => time(),
                'JENIS_USAHA' => $request->jenis_usaha[$key]
            ];
        }

        foreach($request->bahan_baku as $key => $value) {
            $bahan_baku[] = [
                'ID_TEMPAT' => time(),
                'JENIS_BAHAN' => $request->bahan_baku[$key],
                'KAPASITAS' => $request->bahan_baku_kg[$key]
            ];
        }

        foreach($request->penjualan_bahan as $key => $value) {
            $penjualan_bahan[] = [
                'ID_TEMPAT' => time(),
                'TEMPAT_PENJUALAN' => $request->penjualan_bahan[$key],
                'KETERANGAN' => $request->penjualan_bahan_ket[$key]
            ];
        }

        foreach($request->mesin as $key => $value) {
            $mesin[] = [
                'ID_TEMPAT' => time(),
                'MESIN' => $request->mesin[$key],
                'KEPEMILIKAN' => $request->kepemilikan[$key],
                'QTY' => $request->mesin_qty[$key]
            ];
        }

        //dd($data, $jenis_usaha, $bahan_baku, $penjualan_bahan, $mesin);

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
                    'ID_TEMPAT' => time(),
                    'GAMBAR' => $name,
                ];
                $i++;
            }
        }

        DB::beginTransaction();

        try {

            DB::table('tempat')->insert($data);
            DB::table('tempat_jenis_usaha')->insert($jenis_usaha);
            DB::table('tempat_jenis_bahan')->insert($bahan_baku);
            DB::table('tempat_penjualan')->insert($penjualan_bahan);
            DB::table('tempat_mesin')->insert($mesin);
            ($files) ? DB::table('tempat_gambar')->insert($files) : '';

            $response[] = [
                'ID_TEMPAT' => time(),
                'NAMA_USAHA' => $request->nama_usaha,
                'LAT' => $request->lat,
                'LNG' => $request->lng,
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
        $image = DB::table('tempat_gambar')->where('ID_TEMPAT', $id)->get();
        return response()->json($image, 200, []);
    }

    public function getBahanBaku()
    {
        $result = DB::table('m_jenis_bahan')->get(); 

        foreach($result as $row) {
            $response[] = [
                'id' => $row->JENIS_BAHAN,
                'text' => $row->JENIS_BAHAN
            ];
        }

        return response()->json($response, 200, []);
    }

    public function getPenjualanBahan()
    {
        $result = DB::table('m_tempat_penjualan')->get(); 

        foreach($result as $row) {
            $response[] = [
                'id' => strtolower($row->TEMPAT_PENJUALAN),
                'text' => $row->TEMPAT_PENJUALAN
            ];
        }

        return response()->json($response, 200, []);
    }

    public function getMesin()
    {
        $result = DB::table('m_mesin')->get(); 

        foreach($result as $row) {
            $response[] = [
                'id' => strtolower($row->MESIN),
                'text' => $row->MESIN
            ];
        }

        return response()->json($response, 200, []);
    }

    public function getDetailCoord(Request $request)
    {
        if($request->input('id')){

            $id = $request->input('id');
            $tempat = DB::table('tempat')->where('ID_TEMPAT', $id)->first();
            $jenis_usaha = DB::table('tempat_jenis_usaha')->where('ID_TEMPAT', $id)->get();
            $jenis_bahan = DB::table('tempat_jenis_bahan')->where('ID_TEMPAT', $id)->get();
            $penjualan = DB::table('tempat_penjualan')->where('ID_TEMPAT', $id)->get();
            $mesin = DB::table('tempat_mesin')->where('ID_TEMPAT', $id)->get();
            $image = DB::table('tempat_gambar')->where('ID_TEMPAT', $id)->get();
            $response = [
                'tempat' => $tempat,
                'jenis_usaha' => $jenis_usaha,
                'jenis_bahan' => $jenis_bahan,
                'penjualan' => $penjualan,
                'mesin' => $mesin,
                'image' => $image
            ];
            
            return response()->json($response, 200, []);
        }
    }

    public function update(Request $request)
    {
        dd($request);
    }
}
