<?php

namespace App\Http\Controllers\Master;

use App\Helpers\FormatingHelper;
use App\Http\Controllers\Controller;
use App\Models\Master\Satuan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    public function listdata()
    {
        $data = Satuan::where(function($query) {
        $query->where('flag', '!=', '1')
            ->orWhereNull('flag');
        })
        ->when(request('q'), function($x){
           $x->where('satuan', 'like', '%' . request('q') . '%')
           ->orWhere('kodesatuan', 'like', '%' . request('q') . '%');
        })
        ->orderBy('id', 'desc')
        ->simplePaginate(request('per_page'));

        return new JsonResponse($data);
    }

    public function savedata(Request $request)
    {
        $request->validate([
            'satuan' => 'required|string|max:255', // Satuan wajib diisi
            // 'kodesatuan' => 'nullable|string|max:50|unique:satuans,kodesatuan', // Kodesatuan opsional, harus unik
        ]);

        // $cari = Satuan::where('satuan',$request->satuan)->whereNull('flag')->count();
        // if($cari > 0)
        // {
        //     return new JsonResponse(
        //         [
        //             'message' => 'Data Sudah Ada',
        //         ],200
        //     );
        // }

        if($request->kodesatuan === '' || $request->kodesatuan === null)
        {
            $cek = Satuan::count();
            $total = (int) $cek + (int) 1;
            $kodesatuan = FormatingHelper::kodemaster($total,'ST');
        }
        else{
            $kodesatuan = $request->kodesatuan;
        }
        $simpan = Satuan::updateOrCreate(
            [
                'kodesatuan' => $kodesatuan
            ],
            [
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
        $updatehapus = Satuan::find($request->id);
        $updatehapus->flag = '1';
        $updatehapus->save();

        return new JsonResponse(
            [
                'message' => 'Data Sudah Dihapus',
            ],200
        );
    }
}
