<?php

namespace App\Http\Controllers;

use App\Models\Coord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Image;
use File;
use DataTables;

class CoordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Request $request)
    {
        if($request->input('id')){
            $id = $request->input('id');
            $view = 1; 
        } else {
            $id = 0;
            $view = 0;
        }   
        $key = '';
        $keys = DB::table('key_api')->where('aktif', 1)->get();
        $jenis_usaha = DB::table('m_jenis_usaha')->get();
        $jenis_bahan = DB::table('m_jenis_bahan')->get();
        $tempat_penjualan = DB::table('m_tempat_penjualan')->get();
        $jenis_pembayaran = DB::table('m_jenis_pembayaran')->get();
        $mesin = DB::table('m_mesin')->get();
        $plant = DB::table('hrd_2021.m_plant as a')
                ->selectRaw('a.*, b.LAT, b.LNG')
                ->join('tempat as b', 'a.KODE', '=', 'b.KATEGORI', 'LEFT')
                ->orderBy('a.NO_URUT')
                ->get();

        foreach($keys as $row){
            $request = Http::get('https://api.maptiler.com/maps/streets/tiles.json?key=' . $row->key);
            if($request->successful()){
                $key = $row->key;
                break;
            } else {
                DB::table('key_api')->where('key', $row->key)->update(['aktif' => 0]);
            }
        }

        

        return view('map')->with('key', $key)->with('jenis_usaha', $jenis_usaha)->with('jenis_bahan', $jenis_bahan)->with('jenis_pembayaran', $jenis_pembayaran)->with('tempat_penjualan', $tempat_penjualan)->with('mesin', $mesin)->with('i', 0)->with('view', $view)->with('id', $id)->with('plant', $plant)->with('jenis', session()->get('akses')['app']['AKSES_INPUT'][0]);
    }
    //
    public function getCoordinates(Request $request)
    {
        // $coords = DB::table('tempat as a')
        //     ->selectRaw('*, (SELECT GROUP_CONCAT(KODE_PLANT SEPARATOR "|") FROM tempat_jarak as b WHERE b.ID_TEMPAT = a.ID_TEMPAT) AS KODE_PLANT, (SELECT GROUP_CONCAT(JARAK SEPARATOR "|") FROM tempat_jarak as c WHERE c.ID_TEMPAT = a.ID_TEMPAT) AS JARAK')
        //     ->whereNotNull('a.LAT')
        //     ->where('a.AKTIF', 1)
        //     ->whereIn('a.JENIS', session()->get('akses')['app']['AKSES_INPUT'])
        //     ->get();

        $coords = DB::table('tempat as a')
            ->selectRaw('a.*, GROUP_CONCAT(b.KODE_PLANT SEPARATOR "|") AS KODE_PLANT, GROUP_CONCAT(b.JARAK SEPARATOR "|") AS JARAK, MAX(JUMLAH_PENGIRIMAN) AS MAX_WIDTH, (SELECT MAX(JUMLAH_PENGIRIMAN) FROM tempat) AS MAX_KIRIM')
            ->leftJoin(DB::raw('(SELECT ID_TEMPAT, KODE_PLANT, JARAK FROM tempat_jarak ORDER BY KODE_PLANT) as b'), 'a.ID_TEMPAT', '=', 'b.ID_TEMPAT')
            ->whereNotNull('a.LAT')
            ->where('a.AKTIF', 1)
            ->whereIn('a.JENIS', session()->get('akses')['app']['AKSES_INPUT'])
            ->groupBy('a.ID_TEMPAT', 'a.KATEGORI')
            ->orderBy('a.ID_TEMPAT')
            ->get();
            
        //dd($coords);
        return response()->json($coords, 200, []);

    }

    public function getForm(Request $request)
    {
        $form = strtolower($request->form);
        $jenis_usaha = DB::table('m_jenis_usaha')->get();
        $plant = DB::table('hrd_2021.m_plant as a')
                ->selectRaw('a.*, b.LAT, b.LNG')
                ->join('tempat as b', 'a.KODE', '=', 'b.KATEGORI', 'LEFT')
                ->orderBy('a.NO_URUT')
                ->get();

        $form = ($form === 'eterlene') ? 'loco' : $form;

        $jenis = strtolower($request->form);
        
        $form = view("form.$form", compact('jenis_usaha', 'plant', 'jenis'))->render();

        return $form;
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
                $response = [];
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

        //dd($request);

        if($request->jenis == 'SOURCING') {

            $data = [
                'ID_TEMPAT' => time(),
                'JENIS' => $request->jenis,
                'KATEGORI' => $request->kategori,
                'NAMA_USAHA' => $request->nama_usaha,
                'CP' => $request->cp,
                'TELEPON' => $request->telepon,
                'ALAMAT' => $request->alamat,
                'STATUS_USAHA' => $request->status_tempat,
                'JUMLAH_PEKERJA' => $request->jml_pekerja,
                'LAT' => $request->lat,
                'LNG' => $request->lng,
                'TANGGAL_KUNJUNGAN' => date('Y-m-d', strtotime($request->tgl_kunjungan)),
                'TANGGAL_BUAT' => date('Y-m-d H:i:s'),
                'USERNAME' => session()->get('user')['USERNAME'],
                'MARKER' => $request->pin
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
                    'KETERANGAN' => $request->penjualan_bahan_ket[$key],
                    'PROSES_PENJUALAN' => $request->proses_penjualan[$key],
                    'PROSES_PEMBAYARAN' => $request->proses_pembayaran[$key]
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

        } else {
            $data = [
                'ID_TEMPAT' => time(),
                'KODE' => $request->kode,
                'JENIS' => $request->jenis,
                'URUT' => $request->urut,
                'NAMA_USAHA' => $request->nama_usaha,
                'ALAMAT' => $request->alamat,
                'TONASE' => $request->tonase,
                'JUMLAH_PENGIRIMAN' => $request->jumlah_pengiriman,
                'EKSPEDISI' => $request->ekspedisi,
                'LAT' => $request->lat,
                'LNG' => $request->lng,
                'MARKER' => $request->pin,
                'TANGGAL_BUAT' => date('Y-m-d H:i:s'),
                'USERNAME' => session()->get('user')['USERNAME']
            ];

            foreach($request->jenis_kendaraan as $key => $value) {
                $jenis_kendaraan[] = [
                    'ID_TEMPAT' => time(),
                    'JENIS_KENDARAAN' => $request->jenis_kendaraan[$key]
                ];
            }

            foreach($request->plant as $key => $value) {
                $plant_jarak[] = [
                    'ID_TEMPAT' => time(),
                    'KODE_PLANT' => $value,
                    'PLANT' => $request->plant_nama[$key],
                    'JARAK' => $request->jarak[$key] == '' ? 0 : $request->jarak[$key] 
                ];
            }

            $kode_plant = implode("|", $request->plant);
            $jarak = implode("|", $request->jarak);
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

            if($request->jenis == 'SOURCING') {
                DB::table('tempat_jenis_usaha')->insert($jenis_usaha);
                DB::table('tempat_jenis_bahan')->insert($bahan_baku);
                DB::table('tempat_penjualan')->insert($penjualan_bahan);
                DB::table('tempat_mesin')->insert($mesin);

                
            } else {
                DB::table('tempat_jenis_kendaraan')->insert($jenis_kendaraan);
                DB::table('tempat_jarak')->insert($plant_jarak);
            }

            ($files) ? DB::table('tempat_gambar')->insert($files) : '';

            // $response[] = [
            //     'ID_TEMPAT' => $data['ID_TEMPAT'],
            //     'JENIS' => $data['JENIS'],
            //     'KATEGORI' => (isset($data['KATEGORI'])) ? $data['KATEGORI'] : '',
            //     'NAMA_USAHA' => (isset($data['NAMA_USAHA'])) ? $data['NAMA_USAHA'] : '',
            //     'URUT' => (isset($data['URUT'])) ? $data['URUT'] : '',
            //     'CP' => (isset($data['CP'])) ? $data['CP'] : '',
            //     'TELEPON' => (isset($data['TELEPON'])) ? $data['TELEPON'] : '',
            //     'ALAMAT' => (isset($data['ALAMAT'])) ? $data['ALAMAT'] : '',
            //     'STATUS_USAHA' => (isset($data['STATUS_USAHA'])) ? $data['STATUS_USAHA'] : '',
            //     'JUMLAH_PEKERJA' => (isset($data['JUMLAH_PEKERJA'])) ? $data['JUMLAH_PEKERJA'] : '',
            //     'TANGGAL_KUNJUNGAN' => (isset($data['TANGGAL_KUNJUNGAN'])) ? $data['TANGGAL_KUNJUNGAN'] : '',
            //     'TANGGAL_BUAT' => (isset($data['TANGGAL_BUAT'])) ? $data['TANGGAL_BUAT'] : '',
            //     'TONASE' => (isset($data['TONASE'])) ? $data['TONASE'] : '',
            //     'JUMLAH_PENGIRIMAN' => (isset($data['JUMLAH_PENGIRIMAN'])) ? $data['JUMLAH_PENGIRIMAN'] : 0,
            //     'USERNAME' => (isset($data['USERNAME'])) ? $data['USERNAME'] : '',
            //     'MARKER' => (isset($data['MARKER'])) ? $data['MARKER'] : '',
            //     'KODE_PLANT' => (isset($kode_plant)) ? $kode_plant : [],
            //     'JARAK' => (isset($jarak)) ? $jarak : [],
            //     'LAT' => $request->lat,
            //     'LNG' => $request->lng,
            //     'KOSONG' => $request->lat == null ? true : false,
            //     'AKSI' => 'tambah',
            //     'code' => 200,
            // ];

            $code = 200;
            $response = DB::table('tempat as a')
                ->selectRaw('a.*, GROUP_CONCAT(b.KODE_PLANT SEPARATOR "|") AS KODE_PLANT, GROUP_CONCAT(b.JARAK SEPARATOR "|") AS JARAK, MAX(JUMLAH_PENGIRIMAN) AS MAX_WIDTH, (SELECT MAX(JUMLAH_PENGIRIMAN) FROM tempat) AS MAX_KIRIM, "tambah" as AKSI')
                ->leftJoin('tempat_jarak as b', 'a.ID_TEMPAT', '=', 'b.ID_TEMPAT')
                ->leftJoin(DB::raw('(SELECT JENIS, MAX(JUMLAH_PENGIRIMAN) AS MAX_KIRIM FROM tempat GROUP BY JENIS) as c'), 'a.JENIS', '=', 'c.JENIS')
                ->whereNotNull('a.LAT')
                ->where('a.AKTIF', 1)
                ->whereIn('a.JENIS', session()->get('akses')['app']['AKSES_INPUT'])
                ->groupBy('a.ID_TEMPAT', 'a.KATEGORI')
                ->orderBy('a.ID_TEMPAT', 'DESC')
                ->get();
            
            DB::commit();

        } catch (QueryException $e) {
            $code = 500;
            $response[] = [
                'message' => 'Error: ' . '[' . $e->errorInfo[1] . '] ' . $e->errorInfo[2],
                'code' => 500,
            ];
            DB::rollback();

        }

        //dd($response);

        return response()->json($response, $code, []);

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
            $tempat = DB::table('tempat as a')
                    ->selectRaw('a.*, GROUP_CONCAT(b.KODE_PLANT SEPARATOR "|") AS KODE_PLANT, GROUP_CONCAT(b.JARAK SEPARATOR "|") AS JARAK')
                    ->join('tempat_jarak as b', 'a.ID_TEMPAT', '=', 'b.ID_TEMPAT', 'LEFT')
                    ->where('a.ID_TEMPAT', $id)
                    ->first();
            $jenis_usaha = DB::table('tempat_jenis_usaha')->where('ID_TEMPAT', $id)->get();
            $jenis_bahan = DB::table('tempat_jenis_bahan')->where('ID_TEMPAT', $id)->get();
            $jenis_kendaraan = DB::table('tempat_jenis_kendaraan')->where('ID_TEMPAT', $id)->get();
            $penjualan = DB::table('tempat_penjualan')->where('ID_TEMPAT', $id)->get();
            $mesin = DB::table('tempat_mesin')->where('ID_TEMPAT', $id)->get();
            $image = DB::table('tempat_gambar')->where('ID_TEMPAT', $id)->get();
            $jarak = DB::table('tempat_jarak as a')
                    ->selectRaw('a.*, b.LAT, b.LNG')
                    ->join('tempat as b', 'a.KODE_PLANT', '=', 'b.KATEGORI', 'LEFT')
                    ->where('a.ID_TEMPAT', $id)
                    ->orderBy('a.KODE_PLANT', 'ASC')
                    ->get();

            $response = [
                'tempat' => $tempat,
                'jenis_usaha' => $jenis_usaha,
                'jenis_bahan' => $jenis_bahan,
                'jenis_kendaraan' => $jenis_kendaraan,
                'penjualan' => $penjualan,
                'mesin' => $mesin,
                'image' => $image,
                'jarak' => $jarak,
            ];
            
            return response()->json($response, 200, []);
        }
    }

    public function update(Request $request)
    {
        //dd($request);
        if($request->jenis == 'SOURCING') {
            $data = [
                'KATEGORI' => $request->kategori,
                'NAMA_USAHA' => $request->nama_usaha,
                'CP' => $request->cp,
                'TELEPON' => $request->telepon,
                'ALAMAT' => $request->alamat,
                'STATUS_USAHA' => $request->status_tempat,
                'JUMLAH_PEKERJA' => $request->jml_pekerja,
                'LAT' => $request->lat,
                'LNG' => $request->lng,
                'TANGGAL_KUNJUNGAN' => date('Y-m-d', strtotime($request->tgl_kunjungan)),
                'USERNAME' => session()->get('user')['USERNAME'],
                'MARKER' => $request->pin,
                'TANGGAL_UBAH' => date('Y-m-d H:i:s')
            ];
    
            // jenis usaha
            foreach($request->jenis_usaha as $key => $value) {
                $jenis_usaha[] = [
                    'ID_TEMPAT' => $request->id_tempat,
                    'JENIS_USAHA' => $request->jenis_usaha[$key]
                ];
            }
    
            foreach($request->bahan_baku as $key => $value) {
                $bahan_baku[] = [
                    'ID_TEMPAT' => $request->id_tempat,
                    'JENIS_BAHAN' => $request->bahan_baku[$key],
                    'KAPASITAS' => $request->bahan_baku_kg[$key]
                ];
            }
    
            foreach($request->penjualan_bahan as $key => $value) {
                $penjualan_bahan[] = [
                    'ID_TEMPAT' =>  $request->id_tempat,
                    'TEMPAT_PENJUALAN' => $request->penjualan_bahan[$key],
                    'KETERANGAN' => $request->penjualan_bahan_ket[$key],
                    'PROSES_PENJUALAN' => $request->proses_penjualan[$key],
                    'PROSES_PEMBAYARAN' => $request->proses_pembayaran[$key]
                ];
            }
    
            foreach($request->mesin as $key => $value) {
                $mesin[] = [
                    'ID_TEMPAT' => $request->id_tempat,
                    'MESIN' => $request->mesin[$key],
                    'KEPEMILIKAN' => $request->kepemilikan[$key],
                    'QTY' => $request->mesin_qty[$key]
                ];
            }
        } else {
            $data = [
                'NAMA_USAHA' => $request->nama_usaha,
                'KODE' => $request->kode,
                'URUT' => $request->urut,
                'ALAMAT' => $request->alamat,
                'TONASE' => $request->tonase,
                'JUMLAH_PENGIRIMAN' => $request->jumlah_pengiriman,
                'EKSPEDISI' => $request->ekspedisi,
                'LAT' => $request->lat,
                'LNG' => $request->lng,
                'MARKER' => $request->pin,
                'USERNAME' => session()->get('user')['USERNAME'],
                'TANGGAL_UBAH' => date('Y-m-d H:i:s')
            ];

            foreach($request->jenis_kendaraan as $key => $value) {
                $jenis_kendaraan[] = [
                    'ID_TEMPAT' => $request->id_tempat,
                    'JENIS_KENDARAAN' => $request->jenis_kendaraan[$key]
                ];
            }

            foreach($request->plant as $key => $value) {
                $plant_jarak[] = [
                    'ID_TEMPAT' => $request->id_tempat,
                    'KODE_PLANT' => $value,
                    'PLANT' => $request->plant_nama[$key],
                    'JARAK' =>  $request->jarak[$key] == '' ? 0 : $request->jarak[$key] 
                ];
            }

            $kode_plant = implode("|", $request->plant);
            $jarak = implode("|", $request->jarak);
        }

        //For delete image
        $del_image = false;
        if(isset($request->del_image)){
            $del_image = true;
            foreach($request->del_image as $key => $value) {
                if(File::exists(public_path() . '/upload/img/' . $request->del_image[$key])){
                    File::delete(public_path() . '/upload/img/'  . $request->del_image[$key]);
                }
                if(File::exists(public_path() . '/upload/img/thumbnail/' . $request->del_image[$key])){
                    File::delete(public_path() . '/upload/img/thumbnail/'  . $request->del_image[$key]);
                }
            }
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
                    'ID_TEMPAT' => $request->id_tempat,
                    'GAMBAR' => $name,
                ];
                $i++;
            }
        }

        DB::beginTransaction();

        try {

            DB::table('tempat')->where('ID_TEMPAT', $request->id_tempat)->update($data);

            if($request->jenis === 'SOURCING') {
                DB::table('tempat_jenis_usaha')->where('ID_TEMPAT', $request->id_tempat)->delete();
                DB::table('tempat_jenis_bahan')->where('ID_TEMPAT', $request->id_tempat)->delete();
                DB::table('tempat_penjualan')->where('ID_TEMPAT', $request->id_tempat)->delete();
                DB::table('tempat_mesin')->where('ID_TEMPAT', $request->id_tempat)->delete();
    
                DB::table('tempat_jenis_usaha')->insert($jenis_usaha);
                DB::table('tempat_jenis_bahan')->insert($bahan_baku);
                DB::table('tempat_penjualan')->insert($penjualan_bahan);
                DB::table('tempat_mesin')->insert($mesin);
            } else {
                DB::table('tempat_jenis_kendaraan')->where('ID_TEMPAT', $request->id_tempat)->delete();
                DB::table('tempat_jenis_kendaraan')->insert($jenis_kendaraan);

                DB::table('tempat_jarak')->where('ID_TEMPAT', $request->id_tempat)->delete();
                DB::table('tempat_jarak')->insert($plant_jarak);
            }


            ($del_image) ? DB::table('tempat_gambar')->where('ID_TEMPAT', $request->id_tempat)->whereIn('GAMBAR', $request->del_image)->delete() : '';
            ($files) ? DB::table('tempat_gambar')->insert($files) : '';

            // $response[] = [
            //     'ID_TEMPAT' => $request->id_tempat,
            //     'JENIS' => $request->jenis,
            //     'KATEGORI' => (isset($data['KATEGORI'])) ? $data['KATEGORI'] : '',
            //     'NAMA_USAHA' => (isset($data['NAMA_USAHA'])) ? $data['NAMA_USAHA'] : '',
            //     'URUT' => (isset($data['URUT'])) ? $data['URUT'] : '',
            //     'CP' => (isset($data['CP'])) ? $data['CP'] : '',
            //     'TELEPON' => (isset($data['TELEPON'])) ? $data['TELEPON'] : '',
            //     'ALAMAT' => (isset($data['ALAMAT'])) ? $data['ALAMAT'] : '',
            //     'STATUS_USAHA' => (isset($data['STATUS_USAHA'])) ? $data['STATUS_USAHA'] : '',
            //     'JUMLAH_PEKERJA' => (isset($data['JUMLAH_PEKERJA'])) ? $data['JUMLAH_PEKERJA'] : '',
            //     'TANGGAL_KUNJUNGAN' => (isset($data['TANGGAL_KUNJUNGAN'])) ? $data['TANGGAL_KUNJUNGAN'] : '',
            //     'TANGGAL_BUAT' => (isset($data['TANGGAL_BUAT'])) ? $data['TANGGAL_BUAT'] : '',
            //     'TONASE' => (isset($data['TONASE'])) ? $data['TONASE'] : '',
            //     'JUMLAH_PENGIRIMAN' => (isset($data['JUMLAH_PENGIRIMAN'])) ? $data['JUMLAH_PENGIRIMAN'] : 0,
            //     'USERNAME' => (isset($data['USERNAME'])) ? $data['USERNAME'] : '',
            //     'MARKER' => (isset($data['MARKER'])) ? $data['MARKER'] : '',
            //     'KODE_PLANT' => (isset($kode_plant)) ? $kode_plant : [],
            //     'JARAK' => (isset($jarak)) ? $jarak : [],
            //     'LAT' => $request->lat == '' ? null : $request->lat, 
            //     'LNG' => $request->lng == '' ? null : $request->lng,
            //     'KOSONG' => $request->lat == null ? true : false,
            //     'AKSI' => 'ubah',
            //     'code' => 200,
            // ];
            $code = 200;
            $response = DB::table('tempat as a')
                ->selectRaw('a.*, GROUP_CONCAT(b.KODE_PLANT SEPARATOR "|") AS KODE_PLANT, GROUP_CONCAT(b.JARAK SEPARATOR "|") AS JARAK, MAX(JUMLAH_PENGIRIMAN) AS MAX_WIDTH, (SELECT MAX(JUMLAH_PENGIRIMAN) FROM tempat) AS MAX_KIRIM, "update" as AKSI')
                ->leftJoin('tempat_jarak as b', 'a.ID_TEMPAT', '=', 'b.ID_TEMPAT')
                ->whereNotNull('a.LAT')
                ->where('a.AKTIF', 1)
                ->whereIn('a.JENIS', session()->get('akses')['app']['AKSES_INPUT'])
                ->groupBy('a.ID_TEMPAT', 'a.KATEGORI')
                ->orderBy('a.TANGGAL_UBAH', 'DESC')
                ->get();
            DB::commit();

        } catch (QueryException $e) {

            $response[] = [
                'message' => 'Error: ' . '[' . $e->errorInfo[1] . '] ' . $e->errorInfo[2]
            ];
            $code = 500;
            DB::rollback();

        }

        return response()->json($response, $code, []);
    }

    public function delCoord(Request $request)
    {
        $id = $request->id;
        $image = DB::table('tempat_gambar')->where('ID_TEMPAT', $id)->get()->toArray();
        $image = array_column($image, 'GAMBAR');

        DB::beginTransaction();
        
        try {
            DB::table('tempat')->where('ID_TEMPAT', $id)->delete();
            $response[] = [
                'code' => 200
            ];
            $del_image = true;
            DB::commit();
        } catch (QueryException $e) {

            $response[] = [
                'message' => 'Error: ' . '[' . $e->errorInfo[1] . '] ' . $e->errorInfo[2],
                'code' => 500,
            ];
            DB::rollback();
            $del_image = false;
        }

        if($del_image) {
            if(count($image) > 0){
                foreach($image as $key => $value) {
                    if(File::exists(public_path() . '/upload/img/' . $image[$key])){
                        File::delete(public_path() . '/upload/img/'  . $image[$key]);
                    }
                    if(File::exists(public_path() . '/upload/img/thumbnail/' . $image[$key])){
                        File::delete(public_path() . '/upload/img/thumbnail/'  . $image[$key]);
                    }
                }
            }
        }

        return response()->json($response, $response[0]['code'], []);

    }

    public function list(Request $request)
    {
        $id = 0;
        $view = 0;
        $key = '';
        $keys = DB::table('key_api')->where('aktif', 1)->get();
        $jenis_usaha = DB::table('m_jenis_usaha')->get();
        $jenis_bahan = DB::table('m_jenis_bahan')->get();
        $tempat_penjualan = DB::table('m_tempat_penjualan')->get();
        $jenis_pembayaran = DB::table('m_jenis_pembayaran')->get();
        $mesin = DB::table('m_mesin')->get();
        $plant = DB::table('hrd_2021.m_plant as a')
                ->selectRaw('a.*, b.LAT, b.LNG')
                ->join('tempat as b', 'a.KODE', '=', 'b.KATEGORI', 'LEFT')
                ->orderBy('a.NO_URUT')
                ->get();
        foreach($keys as $row){
            $req = Http::get('https://api.maptiler.com/maps/streets/tiles.json?key=' . $row->key);
            if($req->successful()){
                $key = $row->key;
                break;
            } else {
                DB::table('key_api')->where('key', $row->key)->update(['aktif' => 0]);
            }
        }

        //dd($key);

        if($request->i === 'sourcing') {
            $list = 'list';
        } elseif($request->i === 'marketing') {
            $list = 'list2';
        } else {
            abort(404);
        }
        
        
        return view($list)->with('key', $key)->with('jenis_usaha', $jenis_usaha)->with('jenis_bahan', $jenis_bahan)->with('jenis_pembayaran', $jenis_pembayaran)->with('tempat_penjualan', $tempat_penjualan)->with('mesin', $mesin)->with('i', 0)->with('view', $view)->with('id', $id)->with('plant', $plant)->with('jenis', session()->get('akses')['app']['AKSES_INPUT'][0]);
    }

    public function getFilterRecord(Request $request)
    {
        if($request->JENIS_INPUT === 'sourcing') {

            $coords =  DB::table('tempat as A')->selectRaw('A.*, (SELECT GROUP_CONCAT(JENIS_USAHA SEPARATOR "-")  FROM tempat_jenis_usaha as B WHERE B.ID_TEMPAT = A.ID_TEMPAT) as JENIS_USAHA')->where('AKTIF', 1)->where('JENIS', $request->JENIS_INPUT)->where('JENIS', '<>', 'PLANT');
            //dd($coords);
            $datatables = Datatables::of($coords)
            ->addIndexColumn()
            ->editColumn("NAMA_USAHA", function($data){
                $nama_usaha = '<a href="javascript:void" data-id="' . $data->ID_TEMPAT . '" class="text-primary btnDetail">' . $data->NAMA_USAHA .'</a> ';
                return $nama_usaha; 
            })
            ->addColumn("LOKASI",  function($data) {
                if($data->LAT != null || $data->LNG != null ) {
                    $lokasi = '<a href="javascript:void(0)" data-id="' . $data->ID_TEMPAT . '" class="text-primary btnView">Lihat Lokasi</a>'; 
                } else {
                    $lokasi = 'Belum Input';
                }
                return $lokasi;
            })
            ->editColumn("KATEGORI", function($data){
                if($data->KATEGORI == 'supplier') {
                    $kategori = '<span class="badge badge-success" style="text-transform: capitalize">' . $data->KATEGORI .'</span> ';
                } elseif($data->KATEGORI == 'kompetitor') {
                    $kategori = '<span class="badge badge-danger" style="text-transform: capitalize">' . $data->KATEGORI .'</span> ';
                } elseif($data->KATEGORI == 'non supplier') {
                    $kategori = '<span class="badge badge-warning" style="text-transform: capitalize">' . $data->KATEGORI .'</span> ';
                } else {
                    $kategori = '<span class="badge badge-secondary" style="text-transform: capitalize">' . $data->KATEGORI .'</span> ';
                }
                return $kategori; 
            })
            ->editColumn("JENIS_USAHA", function($data){
                $jenis_usaha = $data->JENIS_USAHA;
                $jenis_usaha = explode('-', $jenis_usaha);
                $jenis = '';
                foreach($jenis_usaha as $key => $value){
                    $jenis .= '<span class="badge badge-secondary" style="text-transform: capitalize">' . $jenis_usaha[$key] .'</span>&nbsp;';
                }
                return $jenis;
            })
            ->editColumn("TANGGAL_KUNJUNGAN", function($data){
                $tgl_kunjung = date('d M Y', strtotime($data->TANGGAL_KUNJUNGAN));
                return $tgl_kunjung;
            })
            ->addColumn('AKSI', function($data){
                $aksi = 
                '<div class="btn-group">
                <a href="javascript:void(0)" data-jenis="' . $data->JENIS . '" data-id="' . $data->ID_TEMPAT . '" class="btn btn-smx btn-success btnEdit"><i class="fas fa-fw fa-edit"></i></a>&nbsp;
                <a href="javascript:void(0)" data-id="' . $data->ID_TEMPAT . '" class="btn btn-smx btn-danger btnDelete"><i class="fas fa-fw fa-trash-alt"></i></a>
                </div>';
                return $aksi;
            })
            ->rawColumns(['NAMA_USAHA', 'LOKASI', 'KATEGORI', 'JENIS_USAHA', 'AKSI'])
            ->filter(function ($query) use ($request) {
    
                if ($request->has('KATEGORI')) {
                    if($request->get('KATEGORI') != ''){
                        $query->where('A.KATEGORI', '=', $request->get('KATEGORI'));
                    }
                }
                if($request->has('TGL_DARI')) {
                    if($request->get('TGL_DARI') != ''){
                        $query->where('A.TANGGAL_KUNJUNGAN', '>=', date('Y-m-d', strtotime($request->get('TGL_DARI'))));
                    }
                }
                if($request->has('TGL_SAMPAI')) {
                    if($request->get('TGL_SAMPAI') != ''){
                        $query->where('A.TANGGAL_KUNJUNGAN', '<=', date('Y-m-d', strtotime($request->get('TGL_SAMPAI'))));
                    }
                }
                if ($request->has('LOKASI')) {
                    if($request->get('LOKASI') != ''){
                        if($request->get('LOKASI') == 1) {
                            $query->whereNotNull('A.LAT');
                            $query->whereNotNull('A.LNG');
                        } else {
                            $query->whereNull('A.LAT');
                            $query->whereNull('A.LNG');
                        }
                    }
                }
                if ($request->has('JENIS')) {
                    if($request->get('JENIS') != ''){
                        $jenis = $request->get('JENIS');
                        //$query->where('tempat_jenis_usaha.JENIS_USAHA', '=', $request->get('JENIS'));
                        $query->whereRaw('(SELECT GROUP_CONCAT(JENIS_USAHA SEPARATOR "-")  FROM tempat_jenis_usaha as B WHERE B.ID_TEMPAT = A.ID_TEMPAT) like ?', ["%$jenis%"]);
                    }
                }
                if($request->has('KEYWORD')) {
                    if($request->get('KEYWORD') != ''){
                        $keyword = $request->get('KEYWORD');
                        $query->where('A.NAMA_USAHA', 'like', "%$keyword%");
                        $query->orWhere('A.CP', 'like', "%$keyword%");
                        $query->orWhere('A.TELEPON', 'like', "%$keyword%");
                        $query->orWhere('A.ALAMAT', 'like', "%$keyword%");
                    }
                }
            });
            
        } else {
            $coords =  DB::table('tempat')->where('AKTIF', 1)->whereIn('JENIS', session()->get('akses')['app']['AKSES_INPUT'])->whereNotIn('JENIS', ['PLANT', 'SOURCING']);

            $datatables = Datatables::of($coords)
            ->addIndexColumn()
            ->editColumn("NAMA_USAHA", function($data){
                $distributor = '<a href="javascript:void" data-id="' . $data->ID_TEMPAT . '" class="text-primary btnDetail">' . $data->NAMA_USAHA .'</a> ';
                return $distributor; 
            })
            ->addColumn("LOKASI",  function($data) {
                if($data->LAT != null || $data->LNG != null ) {
                    $lokasi = '<a href="javascript:void(0)" data-id="' . $data->ID_TEMPAT . '" class="text-primary btnView">Lihat Lokasi</a>'; 
                } else {
                    $lokasi = 'Belum Input';
                }
                return $lokasi;
            })
            ->editColumn("JENIS", function($data){
                if($data->JENIS === 'LOCO') {
                    $jenis = '<span class="badge badge-danger" style="text-transform: capitalize">' . $data->JENIS .'</span> ';
                } elseif($data->JENIS === 'ETERLENE') {
                    $jenis = '<span class="badge badge-info" style="text-transform: capitalize">' . $data->JENIS .'</span> ';
                } else {
                    $jenis = 'aa';
                }
                return $jenis; 
            })
            ->editColumn("TANGGAL_BUAT", function($data){
                $tgl_buat = date('d M Y', strtotime($data->TANGGAL_BUAT));
                return $tgl_buat;
            })
            ->addColumn('AKSI', function($data){
                $aksi = 
                '<div class="btn-group">
                <a href="javascript:void(0)" data-jenis="' . $data->JENIS . '" data-id="' . $data->ID_TEMPAT . '" class="btn btn-smx btn-success btnEdit"><i class="fas fa-fw fa-edit"></i></a>&nbsp;
                <a href="javascript:void(0)" data-id="' . $data->ID_TEMPAT . '" class="btn btn-smx btn-danger btnDelete"><i class="fas fa-fw fa-trash-alt"></i></a>
                </div>';
                return $aksi;
            })
            ->rawColumns(['NAMA_USAHA', 'LOKASI', 'JENIS', 'TANGGAL_BUAT', 'AKSI'])
            ->filter(function ($query) use ($request) {
    
                if ($request->has('KATEGORI')) {
                    if($request->get('KATEGORI') != ''){
                        $query->where('JENIS', '=', $request->get('KATEGORI'));
                    }
                }
                if ($request->has('LOKASI')) {
                    if($request->get('LOKASI') != ''){
                        if($request->get('LOKASI') == 1) {
                            $query->whereNotNull('LAT');
                            $query->whereNotNull('LNG');
                        } else {
                            $query->whereNull('LAT');
                            $query->whereNull('LNG');
                        }
                    }
                }
                if($request->has('KEYWORD')) {
                    if($request->get('KEYWORD') != ''){
                        $keyword = $request->get('KEYWORD');
                        $query->where('NAMA_USAHA', 'like', "%$keyword%");
                        $query->orWhere('ALAMAT', 'like', "%$keyword%");
                    }
                }
            });
        }


        return $datatables->make(true);

    }

    public function getFilterCoord(Request $request) {

        $keyword = $request->get('searchTerm');
        $coord = DB::table('tempat')
                ->where('AKTIF', 1)->whereIn('JENIS', session()->get('akses')['app']['AKSES_INPUT'])
                ->whereNotIn('JENIS', ['PLANT'])
                ->where('NAMA_USAHA', 'like', "%$keyword%")
                ->orderBy('NAMA_USAHA', 'ASC')
                ->get();

        foreach($coord as $row){
            $data[] = [
                'id' => $row->ID_TEMPAT . '|' . $row->LAT . '|' . $row->LNG,
                'text' => $row->NAMA_USAHA
            ];
        }

        return response()->json($data, 200);
    }
}
