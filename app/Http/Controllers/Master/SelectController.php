<?php

namespace App\Http\Controllers\Master;

use App\Helpers\FormatingHelper;
use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SelectController extends Controller
{
    public function satuan_all()
    {
       $data = DB::table('satuans')
       ->where(function($query) {
        $query->where('flag', '!=', '1')
            ->orWhereNull('flag');
        })
       ->select('kodesatuan','satuan', 'flag')
       ->get();

       return new JsonResponse($data);
    }
    public function satuan_filter()
    {
       $data = DB::table('satuans')
       ->where(function($query) {
        $query->where('flag', '!=', '1')
            ->orWhereNull('flag');
        })
        ->select('satuan', 'flag')
        ->where('satuan', 'like', '%' . request('q') . '%')
        ->limit(request('limit'))
        ->get();

       return new JsonResponse($data);
    }

    public function kategori_all()
    {
       $data = DB::table('kategoris')
       ->where(function($query) {
        $query->where('flag', '!=', '1')
            ->orWhereNull('flag');
        })
       ->select('kodekategori','kategori','flag')
       ->get();

       return new JsonResponse($data);
    }

    public function produk_all()
    {
       $data = DB::table('produks')
       ->where(function($query) {
        $query->where('flag', '!=', '1')
            ->orWhereNull('flag');
        })
       ->select('produks.*')
       ->get();

       return new JsonResponse($data);
    }

    public function pelanggan_all()
    {
       $data = DB::table('pelanggans')
       ->where(function($query) {
        $query->where('flag', '!=', '1')
            ->orWhereNull('flag');
        })
       ->select('kodepelanggan','pelanggan','alamat','nohp', 'flag')
       ->get();

       return new JsonResponse($data);
    }

    // public function barang_filter()
    // {
    //     $data = DB::table('barangs')
    //     ->select('*')
    //     ->where('namabarang','like','%'. request('q') . '%')
    //     ->limit(request('limit'))
    //     ->get();

    //     return new JsonResponse($data);
    // }

    // public function get_brand()
    // {
    //    $data = DB::table('brands')
    //    ->select('brand', 'flaging')
    //    ->get();

    //    return new JsonResponse($data);
    // }
}
