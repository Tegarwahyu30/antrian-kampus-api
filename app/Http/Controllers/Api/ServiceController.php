<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();

        return response()->json([
            'success' => true,
            'message' => 'Daftar layanan berhasil diambil',
            'data' => $services
        ]);
    }

   public function store(Request $request)
{
    $request->validate([
        'service_name' => 'required'
    ]);

    $service = new Service();
    $service->service_name = $request->service_name;
    $service->service_code = uniqid();
    $service->save();

    return response()->json([
        'success' => true,
        'message' => 'Layanan berhasil ditambahkan',
        'data' => $service
    ]);
}
}