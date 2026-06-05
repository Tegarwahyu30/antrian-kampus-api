<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Antrian;

class AntrianController extends Controller
{
    // GET data antrian
    public function index()
    {
        $antrian = Antrian::with('service')->get();

        return response()->json([
            'success' => true,
            'data' => $antrian
        ]);
    }

    // POST buat antrian
    public function store(Request $request)
{
    $today = date('Y-m-d');

    $serviceId = $request->service_id ?? 1;

    $count = Antrian::where(
        'service_id',
        $serviceId
    )->count();

    $queueNumber =
        'A' .
        str_pad(
            $count + 1,
            3,
            '0',
            STR_PAD_LEFT
        );

    $antrian = Antrian::create([

        'nama' => $request->nama,

        'nim' => $request->nim,

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
    // ✅ SHOW (HARUS DI LUAR STORE)
    public function show($id)
    {
        $data = Antrian::with('service')->find($id);

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
    public function update(Request $request, $id)
{
    $data = Antrian::find($id);

    if (!$data) {
        return response()->json([
            'message' => 'Data tidak ditemukan'
        ], 404);
    }

    $data->update([
        'status' => $request->status
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Status berhasil diupdate',
        'data' => $data
    ]);
}
// ⬇️ INI DI LUAR UPDATE
public function destroy($id)
{
    $data = Antrian::find($id);

    if (!$data) {
        return response()->json([
            'message' => 'Data tidak ditemukan'
        ], 404);
    }

    $data->delete();

    return response()->json([
        'success' => true,
        'message' => 'Data berhasil dihapus'
    ]);
}

}
