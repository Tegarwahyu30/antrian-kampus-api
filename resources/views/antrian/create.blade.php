@extends('layouts.app')

@section('content')

<div class="card" style="
    max-width:700px;
    margin:auto;
    background:white;
    padding:30px;
    border-radius:12px;
">

    <h1>Tambah Antrian</h1>

    <br>

    <form action="/antrian/store" method="POST">

        @csrf

        {{-- NAMA --}}
        <label>Nama Mahasiswa</label>

        <input
            type="text"
            name="nama"
            placeholder="Masukkan nama mahasiswa"
            required
            style="
                width:100%;
                padding:12px;
                margin-top:8px;
                margin-bottom:20px;
                border:1px solid #ccc;
                border-radius:8px;
            "
        >

        {{-- NIM --}}
        <label>NIM</label>

        <input
            type="text"
            name="nim"
            placeholder="Masukkan NIM"
            required
            style="
                width:100%;
                padding:12px;
                margin-top:8px;
                margin-bottom:20px;
                border:1px solid #ccc;
                border-radius:8px;
            "
        >

        {{-- KEPERLUAN --}}
        <label>Keperluan</label>

        <textarea
            name="keperluan"
            rows="4"
            placeholder="Masukkan keperluan mahasiswa"
            required
            style="
                width:100%;
                padding:12px;
                margin-top:8px;
                margin-bottom:20px;
                border:1px solid #ccc;
                border-radius:8px;
            "
        ></textarea>

        {{-- LAYANAN --}}
        <label>Pilih Layanan</label>

        <select
            name="service_id"
            required
            style="
                width:100%;
                padding:12px;
                margin-top:8px;
                margin-bottom:20px;
                border:1px solid #ccc;
                border-radius:8px;
            "
        >

            <option value="">
                -- Pilih Layanan --
            </option>

            @foreach($services as $service)

                <option value="{{ $service->id }}">

                    {{ $service->service_name }}

                </option>

            @endforeach

        </select>

        {{-- TANGGAL --}}
        <label>Tanggal Antrian</label>

        <input
            type="date"
            name="queue_date"
            required
            style="
                width:100%;
                padding:12px;
                margin-top:8px;
                margin-bottom:20px;
                border:1px solid #ccc;
                border-radius:8px;
            "
        >

        {{-- STATUS --}}
        <label>Status</label>

        <select
            name="status"
            style="
                width:100%;
                padding:12px;
                margin-top:8px;
                margin-bottom:25px;
                border:1px solid #ccc;
                border-radius:8px;
            "
        >

            <option value="waiting">
                Waiting
            </option>

            <option value="process">
                Process
            </option>

            <option value="done">
                Done
            </option>

        </select>

        {{-- BUTTON --}}
        <button
            class="btn"
            type="submit"
            style="
                background:#2563eb;
                color:white;
                border:none;
                padding:12px 20px;
                border-radius:8px;
                cursor:pointer;
            "
        >
            Simpan Antrian
        </button>

    </form>

</div>

@endsection