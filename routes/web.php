<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ServiceController;
use App\Models\Antrian;
use App\Models\Service;
use Illuminate\Http\Request;

Route::get('/', function () {

    $totalAntrian = Antrian::count();

    $waiting = Antrian::where(
        'status',
        'waiting'
    )->count();

    $process = Antrian::where(
        'status',
        'process'
    )->count();

    $done = Antrian::where(
        'status',
        'done'
    )->count();

    $totalLayanan = Service::count();

    // ANTRIAN TERBARU
    $latestAntrians = Antrian::with('service')
        ->latest()
        ->take(5)
        ->get();
    // STATISTIK PER LAYANAN
$serviceStats = Service::withCount('antrians')->get();

    return view('dashboard', compact(
        'totalAntrian',
        'waiting',
        'process',
        'done',
        'totalLayanan',
        'latestAntrians',
        'serviceStats'
    ));

});

Route::get('/services', [ServiceController::class, 'index']);


// ======================================================
// ANTRIAN
// ======================================================

Route::get('/antrian', function (Request $request) {

    $query = Antrian::with('service');

    // SEARCH
    if ($request->search) {

        $query->where(function ($q) use ($request) {

            $q->where(
                'nama',
                'like',
                '%' . $request->search . '%'
            )

            ->orWhere(
                'nim',
                'like',
                '%' . $request->search . '%'
            )

            ->orWhere(
                'queue_number',
                'like',
                '%' . $request->search . '%'
            );

        });

    }

    // FILTER LAYANAN
    if ($request->service_id) {

        $query->where(
            'service_id',
            $request->service_id
        );

    }

    // FILTER STATUS
    if ($request->status) {

        $query->where(
            'status',
            $request->status
        );

    }

    $antrians = $query
        ->latest()
        ->get();

    $services = Service::all();

    return view(
        'antrian.index',
        compact('antrians', 'services')
    );

});

Route::get('/antrian/create', function () {

    $services = Service::all();

    return view(
        'antrian.create',
        compact('services')
    );

});

Route::post('/antrian/store', function (Request $request) {

    // AMBIL DATA LAYANAN
    $service = Service::findOrFail(
        $request->service_id
    );

    // PREFIX DARI KODE LAYANAN
    $prefix = $service->service_code;

    // HITUNG TOTAL ANTRIAN PER LAYANAN
    $totalQueue = Antrian::where(
        'service_id',
        $service->id
    )->count() + 1;

    // FORMAT NOMOR ANTRIAN
    $queueNumber =
        $prefix .
        str_pad($totalQueue, 4, '0', STR_PAD_LEFT);

    // SIMPAN DATA
    Antrian::create([

        'nama' => $request->nama,

        'nim' => $request->nim,

        'keperluan' => $request->keperluan,

        'service_id' => $request->service_id,

        'queue_number' => $queueNumber,

        'queue_date' => $request->queue_date,

        'status' => $request->status,

    ]);

    return redirect('/antrian');

});

Route::get('/antrian/edit/{id}', function ($id) {

    $antrian = Antrian::findOrFail($id);

    $services = Service::all();

    return view(
        'antrian.edit',
        compact('antrian', 'services')
    );

});

Route::post('/antrian/update/{id}', function (
    Request $request,
    $id
) {

    $antrian = Antrian::findOrFail($id);

    $antrian->update([

        'nama' => $request->nama,

        'nim' => $request->nim,

        'keperluan' => $request->keperluan,

        'service_id' => $request->service_id,

        'queue_date' => $request->queue_date,

        'status' => $request->status,

    ]);

    return redirect('/antrian');

});


// ==========================================
// UPDATE STATUS OTOMATIS
// ==========================================

Route::get('/antrian/status/{id}', function ($id) {

    $antrian = Antrian::findOrFail($id);

    // WAITING -> PROCESS
    if ($antrian->status == 'waiting') {

        $antrian->status = 'process';

    }

    // PROCESS -> DONE
    elseif ($antrian->status == 'process') {

        $antrian->status = 'done';

    }

    $antrian->save();

    return redirect('/antrian');

});


Route::get('/antrian/delete/{id}', function ($id) {

    $antrian = Antrian::findOrFail($id);

    $antrian->delete();

    return redirect('/antrian');

});


// ======================================================
// LAYANAN
// ======================================================

Route::get('/layanan', function () {

    $services = Service::latest()->get();

    return view('layanan.index', compact('services'));

});

Route::get('/layanan/create', function () {

    return view('layanan.create');

});

Route::post('/layanan/store', function (
    Request $request
) {

    // HITUNG JUMLAH LAYANAN
    $totalService = Service::count();

    // AUTO HURUF A B C D
    $serviceCode = chr(65 + $totalService);

    Service::create([

        'service_name' => $request->service_name,

        'service_code' => $serviceCode

    ]);

    return redirect('/layanan');

});

Route::get('/layanan/edit/{id}', function ($id) {

    $service = Service::findOrFail($id);

    return view('layanan.edit', compact('service'));

});

Route::post('/layanan/update/{id}', function (
    Request $request,
    $id
) {

    $service = Service::findOrFail($id);

    $service->update([

        'service_name' => $request->service_name

    ]);

    return redirect('/layanan');

});

Route::get('/layanan/delete/{id}', function ($id) {

    $service = Service::findOrFail($id);

    $service->delete();

    return redirect('/layanan');

});