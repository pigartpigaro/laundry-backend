<?php

namespace App\Http\Controllers\Master;

use App\Helpers\FormatingHelper;
use App\Http\Controllers\Controller;
use App\Models\Master\Produk;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function listdata()
    {

        $data = Produk::where('flag', '=', '')
        ->orWhere('flag', '=', null)
        ->when(request('q') !== '' || request('q') !== null, function($x){
           $x->where('produk', 'like', '%' . request('q') . '%')
           ->orWhere('kodeproduk', 'like', '%' . request('q') . '%')
           ->orWhere('kategori', 'like', '%' . request('q') . '%')
           ->orWhere('satuan', 'like', '%' . request('q') . '%')
           ;
        })
        ->orderBy('id', 'desc')
        ->simplePaginate(request('per_page'));

        return new JsonResponse($data);
    }

    public function savedata(Request $request)
    {
        $request->validate([
            'produk' => 'required|string|max:255', // Satuan wajib diisi
            // 'kodesatuan' => 'nullable|string|max:50|unique:satuans,kodesatuan', // Kodesatuan opsional, harus unik
        ]);
        // $cari = Produk::where('produk',$request->produk)->whereNull('flag')->count();
        // if($cari > 0)
        // {
        //     return new JsonResponse(
        //         [
        //             'message' => 'Data Sudah Ada',
        //         ],200
        //     );
        // }

        if($request->kodeproduk === '' || $request->kodeproduk === null)
        {
            $cek = Produk::count();
            $total = (int) $cek + (int) 1;
            $kodeproduk = FormatingHelper::kodemaster($total,'PRO');
        }
        else{
            $kodeproduk = $request->kodeproduk;
        }
        $simpan = Produk::updateOrCreate(
            [
                'kodeproduk' => $kodeproduk
            ],
            [
                'produk' => $request->produk,
                'harga' => $request->harga,
                'kodekategori' => $request->kodekategori,
                'kategori' => $request->kategori,
                'kodesatuan' => $request->kodesatuan,
                'satuan' => $request->satuan,
            ]
        );

        return new JsonResponse(
            [
                'message' => 'Data Tersimpan',
                'result' => $simpan
            ],200
        );
    }

      public function deletedata(Request $request)
    {
        $updatehapus = Produk::find($request->id);
        $updatehapus->flag = '1';
        $updatehapus->save();

        return new JsonResponse(
            [
                'message' => 'Data Sudah Dihapus',
            ],200
        );
    }
}
