<?php

namespace App\Http\Controllers\Master;

use App\Helpers\FormatingHelper;
use App\Http\Controllers\Controller;
use App\Models\Master\Kategori;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function listdata()
    {

        $data = Kategori::where('flag', '=', '')
        ->orWhere('flag', '=', null)
        ->when(request('q') !== '' || request('q') !== null, function($x){
           $x->where('kategori', 'like', '%' . request('q') . '%')
           ->orWhere('kodekategori', 'like', '%' . request('q') . '%');
        })
        ->orderBy('id', 'desc')
        ->simplePaginate(request('per_page'));

        return new JsonResponse($data);
    }

    public function savedata(Request $request)
    {
        $request->validate([
            'kategori' => 'required|string|max:255', // Satuan wajib diisi
            // 'kodesatuan' => 'nullable|string|max:50|unique:satuans,kodesatuan', // Kodesatuan opsional, harus unik
        ]);
        $cari = Kategori::where('kategori',$request->kategori)->whereNull('flag')->count();
        if($cari > 0)
        {
            return new JsonResponse(
                [
                    'message' => 'Data Sudah Ada',
                ],200
            );
        }

        if($request->kodekategori === '' || $request->kodekategori === null)
        {
            $cek = Kategori::count();
            $total = (int) $cek + (int) 1;
            $kodekategori = FormatingHelper::kodemaster($total,'KTG');
        }
        else{
            $kodekategori = $request->kodekategori;
        }
        $simpan = Kategori::updateOrCreate(
            [
                'kodekategori' => $kodekategori
            ],
            [
                'kategori' => $request->kategori
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
        $updatehapus = Kategori::find($request->id);
        $updatehapus->flag = '1';
        $updatehapus->save();

        return new JsonResponse(
            [
                'message' => 'Data Sudah Dihapus',
            ],200
        );
    }
}
