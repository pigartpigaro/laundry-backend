<?php

namespace App\Http\Controllers\Order;

use App\Helpers\FormatingHelper;
use App\Http\Controllers\Controller;
use App\Models\Order\Transaksi;
use App\Models\Order\Transaksirinci;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function listorder()
    {
        $data = Transaksi::where('transaksis.status', '=', 0)
        ->when(request('q') !== '' || request('q') !== null, function($x){
            $x->where('transaksis.no_nota', 'like', '%' . request('q') . '%')
            ->orWhere('transaksis.pelanggan', 'like', '%' . request('q') . '%')
            ->orWhere('transaksis.tanggal', 'like', '%' . request('q') . '%')
            ;
        }) ->with('rincians')
        // ->select('transaksis.*', 'transaksirincis.*')
        //  ->leftJoin('transaksirincis', function ($join) {
        //         $join->on('transaksis.no_nota', '=', 'transaksirincis.no_nota');
        //     })
        // ->rightJoin('transaksirincis', 'transaksirincis.no_nota', 'transaksis.no_nota')
        ->orderBy('transaksis.id', 'desc')
        ->simplePaginate(request('per_page'));

        return new JsonResponse($data);
    }
    public function saveorder(Request $request)
    {
        $request->validate([
            'pelanggan' => 'required|string|max:255', // Validasi untuk header
            'rincians' => 'required|array|min:1', // Pastikan rincians ada dan tidak kosong
            'rincians.*.produk' => 'required|string|max:255', // Validasi produk di setiap rincian
        ]);

        if($request->no_nota === '' || $request->no_nota === null)
        {
            $cek = Transaksi::count();
            $total = (int) $cek + (int) 1;
            $nonota = FormatingHelper::kodenota($total,'NAMI');
        }
        else{
            $nonota = $request->no_nota;
        }

         try{
            DB::beginTransaction();
            $tgl = date('Y-m-d');
            $time = date('H:i:s');
            $save = Transaksi::updateOrCreate(
                [
                    'no_nota' => $nonota
                ],
                [
                    'tanggal' => $tgl,
                    'time' => $time,
                    'kodepelanggan' => $request->kodepelanggan,
                    'pelanggan' => $request->pelanggan,
                    'alamat' => $request->alamat,
                    'nohp' => $request->nohp,
                ]
            );
            foreach ($request->rincians as $rinci){
                $save->rincians()->create(
                    [
                    'no_nota' => $save->no_nota,
                    'kodeproduk' => $rinci['kodeproduk'] ?? '',
                    'produk' => $rinci['produk'] ?? '' ,
                    'kategori' => $rinci['kategori'] ?? '' ,
                    'satuan' => $rinci['satuan'] ?? '' ,
                    'kuantitas' => $rinci['kuantitas'] ?? '' ,
                    'harga' => $rinci['harga'] ?? '' ,
                    'subtotal' => $rinci['subtotal'] ?? '' ,
                    'keterangan' => $rinci['keterangan'] ?? '' ,
                    ]);
            }
            DB::commit();

        return new JsonResponse(
                [
                    'message' => 'Data Berhasil disimpan...!!!',
                    'result' => $save,
                ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return new JsonResponse(['message' => 'ada kesalahan', 'error' => $e], 500);
        }
    }
    public static function orderrinci($nonota)
    {
        $list = Transaksi::with(
            [
                'rinci'
                => function($rinci){
                    $rinci->select('*',DB::raw('(kuantitas*harga) as subtotal'));
                }
            ]
        )
        ->where('nonota', $nonota)
        ->orderBy('id', 'desc')
        ->get();
        return $list;
    }
    public function deleteorder(Request $request)
    {
        // Cari gambar berdasarkan ID
        $cari = Transaksirinci::find($request->id);

        if (!$cari) {
            return response()->json([
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        // Hapus data dari database
        $hapus = $cari->delete();

        if(!$hapus)
        {
            return new JsonResponse(['message' => 'Data Gagal Dihapus'],500);
        }

        return response()->json([
            'message' => 'Gambar berhasil dihapus'
        ], 200);
    }
}
