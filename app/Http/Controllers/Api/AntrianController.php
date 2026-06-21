<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Antrian;
use App\Models\Service;

class AntrianController extends Controller
{
    // ==================================================
    // GET SEMUA ANTRIAN
    // ==================================================
    public function index()
    {
        $antrian = Antrian::with(['service', 'user'])->get();

        return response()->json([
            'success' => true,
            'data' => $antrian
        ]);
    }

    // ==================================================
    // GET ANTRIAN MILIK USER LOGIN
    // ==================================================
    public function myAntrian(Request $request)
    {
        $data = Antrian::with('service')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    // ==================================================
// BUAT ANTRIAN BARU
// ==================================================
public function store(Request $request)
{
    $today = date('Y-m-d');
    $serviceId = $request->service_id;
    $service = Service::findOrFail($serviceId);

    // --- TAMBAHKAN LOGIKA VALIDASI DI SINI ---
    $antrianAktif = Antrian::where('user_id', $request->user()->id)
        ->where('service_id', $serviceId)
        ->where('queue_date', $today)
        ->whereNotIn('status', ['done', 'cancelled']) // Status yang dianggap masih aktif
        ->first();

    if ($antrianAktif) {
        return response()->json([
            'success' => false,
            'message' => 'Anda masih memiliki antrean aktif untuk layanan ini. Selesaikan antrean sebelumnya terlebih dahulu.',
        ], 400); // Kode 400 = Bad Request
    }
    // --- AKHIR VALIDASI ---

    $prefix = $service->service_code;

    $count = Antrian::where(
        'service_id',
        $serviceId
    )->where('queue_date', $today)->count(); // Penting: tambahkan where date agar hitungan per hari

    $queueNumber =
        $prefix .
        str_pad(
            $count + 1,
            3,
            '0',
            STR_PAD_LEFT
        );

    $antrian = Antrian::create([
        'user_id' => $request->user()->id,
        'nama' => $request->user()->name,
        'nim' => $request->user()->nim,
        'keperluan' => $request->keperluan,
        'service_id' => $serviceId,
        'queue_number' => $queueNumber,
        'queue_date' => $today,
        'status' => 'waiting'
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Antrian berhasil dibuat',
        'data' => $antrian
    ]);
}

    // ==================================================
    // DETAIL ANTRIAN
    // ==================================================
    public function show($id)
    {
        $data = Antrian::with(['service', 'user'])
            ->find($id);

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

   // ==================================================
    // UPDATE ANTRIAN
    // ==================================================
    public function update(Request $request, $id)
{
    $antrian = Antrian::find($id);

    if (!$antrian) {
        return response()->json(['message' => 'Data tidak ditemukan'], 404);
    }

    if ($antrian->user_id !== $request->user()->id) {
        return response()->json(['message' => 'Forbidden'], 403);
    }

    // KEMBALIKAN KE LOGIKA ASLI
    $antrian->update([
        'keperluan' => $request->keperluan ?? $antrian->keperluan,
        'status'    => $request->status ?? $antrian->status
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Status berhasil diupdate',
        'data' => $antrian
    ]);
}

    // ==================================================
    // HAPUS ANTRIAN
    // ==================================================
    public function destroy(Request $request, $id)
    {
        $antrian = Antrian::find($id);

        if (!$antrian) {
            return response()->json([
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        // Hanya pemilik antrian yang boleh hapus
        if (
            $antrian->user_id !==
            $request->user()->id
        ) {
            return response()->json([
                'message' => 'Forbidden'
            ], 403);
        }

        $antrian->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }
}