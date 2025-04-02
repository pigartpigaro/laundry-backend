<?php

namespace App\Http\Controllers\Pembayaran;

use App\Helpers\FormatingHelper;
use App\Http\Controllers\Controller;
use App\Models\Order\Transaksi;
use App\Models\Pembayaran\Pembayaran;
use App\Models\Pembayaran\Pembayaranrinci;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{
    public function savepay(Request $request)
    {
        $request->validate([
            'kodepelanggan' => 'required',
            'pelanggan' => 'required',
            'alamat' => 'required',
            'nohp' => 'required',
            'jnsbayar' => 'required',
            'total' => 'required|numeric',
            'rincians' => 'required|array',
            'rincians.*.no_nota' => 'required',
            'rincians.*.subtotal' => 'required|numeric',
        ]);
         if($request->kodebayar === '' || $request->kodebayar === null)
        {
            $cek = Pembayaran::count();
            $total = (int) $cek + (int) 1;
            $kodebayar = FormatingHelper::kodenota($total,'LUNAS-NAMI');
        }
        else{
            $kodebayar = $request->kodebayar;
        }

        try {
            DB::beginTransaction();
            $tgl = date('Y-m-d');
            $time = date('H:i:s');
            // Simpan data pembayaran
            $pembayaran = Pembayaran::create([
                'kodebayar' => $kodebayar,
                'tanggal' => $tgl,
                'time' => $time,
                'kodepelanggan' => $request->kodepelanggan,
                'pelanggan' => $request->pelanggan,
                'alamat' => $request->alamat,
                'nohp' => $request->nohp,
                'jnsbayar' => $request->jnsbayar,
                'total' => $request->total,
                'totalbayar' => $request->totalbayar,
                'kembalian' => $request->kembalian,
            ]);

            // Simpan rincian pembayaran
            foreach ($request->rincians as $nota) {
                Pembayaranrinci::create([
                    'kodebayar' => $pembayaran->kodebayar,
                    'no_nota' => $nota['no_nota'],
                    'subtotal' => $nota['subtotal'],
                ]);

                // Update status transaksi
                Transaksi::where('no_nota', $nota['no_nota'])->update(['status' => 1]);
            }

            DB::commit();

            return new JsonResponse(
                [
                    'message' => 'Data Berhasil disimpan...!!!',
                    'result' => $pembayaran, $nota
                ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Pembayaran gagal disimpan: ' . $e->getMessage()], 500);
        }
    }
}
