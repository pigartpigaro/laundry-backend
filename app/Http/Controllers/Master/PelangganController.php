<?php

namespace App\Http\Controllers\Master;

use App\Helpers\FormatingHelper;
use App\Http\Controllers\Controller;
use App\Models\Master\Pelanggan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function listdata()
    {

        $data = Pelanggan::where(function($query) {
        $query->where('flag', '!=', '1')
            ->orWhereNull('flag');
        })
        ->when(request('q'), function($x){
           $x->where('pelanggan', 'like', '%' . request('q') . '%')
           ->orWhere('kodepelanggan', 'like', '%' . request('q') . '%');
        })
        ->orderBy('id', 'desc')
        ->simplePaginate(request('per_page'));

        return new JsonResponse($data);
    }

    public function savedata(Request $request)
    {
        $request->validate([
            'pelanggan' => 'required|string|max:255', // Satuan wajib diisi
            // 'nohp' => 'required|numeric|max:15', // Satuan wajib diisi
            // 'kodesatuan' => 'nullable|string|max:50|unique:satuans,kodesatuan', // Kodesatuan opsional, harus unik
        ]);
        // $cari = Pelanggan::where('pelanggan',$request->pelanggan)->whereNull('flag')->count();
        // if($cari > 0)
        // {
        //     return new JsonResponse(
        //         [
        //             'message' => 'Data Sudah Ada',
        //         ],200
        //     );
        // }

        if($request->kodepelanggan === '' || $request->kodepelanggan === null)
        {
            $cek = Pelanggan::count();
            $total = (int) $cek + (int) 1;
            $kode = FormatingHelper::kodemaster($total,'CSTM');
        }
        // else{
        //     $kode = $request->kode;
        // }
        $simpan = Pelanggan::updateOrCreate(
            [
                'kodepelanggan' => $kode
            ],
            [
                'pelanggan' => $request->pelanggan,
                'alamat' => $request->alamat,
                'nohp' => $request->nohp,
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
        $updatehapus = Pelanggan::find($request->id);
        $updatehapus->flag = '1';
        $updatehapus->save();

        return new JsonResponse(
            [
                'message' => 'Data Sudah Dihapus',
            ],200
        );
    }
}
