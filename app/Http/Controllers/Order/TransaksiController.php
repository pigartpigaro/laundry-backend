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
            'pelanggan' => 'required|string',
            'alamat' => 'required|string',
            'nohp' => 'required|string',
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
           // Simpan/update transaksi utama
            $transaksi = Transaksi::updateOrCreate(
                ['no_nota' => $nonota],
                [
                    'tanggal' => $tgl,
                    'time' => $time,
                    'kodepelanggan' => $request->kodepelanggan,
                    'pelanggan' => $request->pelanggan,
                    'alamat' => $request->alamat,
                    'nohp' => $request->nohp,
                ]
            );

        // Hapus semua rincian lama untuk transaksi ini
        Transaksirinci::where('no_nota', $nonota)->delete();

        // Siapkan data rincian baru dengan menghitung subtotal
        $rincianData = array_map(function($item) use ($nonota) {
            return [
                'no_nota' => $nonota,
                'kodeproduk' => $item['kodeproduk'],
                'produk' => $item['produk'],
                'kategori' => $item['kategori'],
                'satuan' => $item['satuan'],
                'kuantitas' => $item['kuantitas'],
                'harga' => $item['harga'],
                'subtotal' => $item['kuantitas'] * $item['harga'],
                'created_at' => now(),
                'updated_at' => now()
            ];
        }, $request->rincians);

        // Insert semua rincian sekaligus
        Transaksirinci::insert($rincianData);

            DB::commit();

        return new JsonResponse(
                [
                    'message' => 'Data Berhasil disimpan...!!!',
                    'nomer' => $nonota,
                    'result' => $transaksi,
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
        ->where('no_nota', $nonota)
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

         $rinciAll = Transaksirinci::where('id', $request->id)->get();
        if(count($rinciAll) === 0){
            $header = Transaksi::where('no_nota', $request->no_nota)->first();

             if ($header) {
                $header->delete();

                return new JsonResponse([
                    'message' => 'Data Berhasil dihapus',
                    'data' => []
                ], 200);
            } else {
                return new JsonResponse([
                    'message' => 'Data header tidak ditemukan',
                ], 404);
            }

        }

        return response()->json([
            'message' => 'Data Berhasil dihapus'
        ], 200);
    }
}
