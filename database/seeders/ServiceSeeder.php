<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('services')->insert([
            [
                'service_code' => 'AKD',
                'service_name' => 'Akademik',
                'description' => 'Layanan administrasi akademik mahasiswa',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_code' => 'KEU',
                'service_name' => 'Keuangan',
                'description' => 'Layanan pembayaran dan administrasi keuangan',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_code' => 'PER',
                'service_name' => 'Perpustakaan',
                'description' => 'Layanan perpustakaan kampus',
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}