<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ServiceController;
use App\Models\Antrian;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/services', [ServiceController::class, 'index']);

Route::get('/antrian', function () {

    $antrians = Antrian::latest()->get();

    return view('antrian.index', compact('antrians'));

});

Route::get('/antrian/create', function () {

    return view('antrian.create');

});

Route::post('/antrian/store', function (Request $request) {

    Antrian::create([
        'user_id' => 1,
        'service_id' => 1,
        'queue_number' => $request->queue_number,
        'queue_date' => $request->queue_date,
        'status' => $request->status,
    ]);

    return redirect('/antrian');

});

Route::get('/antrian/edit/{id}', function ($id) {

    $antrian = Antrian::findOrFail($id);

    return view('antrian.edit', compact('antrian'));

});

Route::post('/antrian/update/{id}', function (Request $request, $id) {

    $antrian = Antrian::findOrFail($id);

    $antrian->update([
        'queue_number' => $request->queue_number,
        'queue_date' => $request->queue_date,
        'status' => $request->status,
    ]);

    return redirect('/antrian');

});

Route::get('/antrian/delete/{id}', function ($id) {

    $antrian = Antrian::findOrFail($id);

    $antrian->delete();

    return redirect('/antrian');

});
Route::get('/layanan', function () {

    $services = \App\Models\Service::latest()->get();

    return view('layanan.index', compact('services'));

});
Route::get('/layanan/create', function () {

    return view('layanan.create');

});
Route::post('/layanan/store', function (Request $request) {

    \App\Models\Service::create([

        'service_name' => $request->service_name,
        'service_code' => strtoupper(substr($request->service_name, 0, 3))

    ]);

    return redirect('/layanan');

});
Route::get('/layanan/edit/{id}', function ($id) {

    $service = \App\Models\Service::findOrFail($id);

    return view('layanan.edit', compact('service'));

});
Route::post('/layanan/update/{id}', function (Request $request, $id) {

    $service = \App\Models\Service::findOrFail($id);

    $service->update([

        'service_name' => $request->service_name,
        'service_code' => strtoupper(substr($request->service_name, 0, 3))

    ]);

    return redirect('/layanan');

});
Route::get('/layanan/delete/{id}', function ($id) {

    $service = \App\Models\Service::findOrFail($id);

    $service->delete();

    return redirect('/layanan');

});