@extends('layouts.app')

@section('content')

<div class="card" style="max-width:600px; margin:auto;">

    <h1>Tambah Layanan</h1>

    <br>

    <form action="/layanan/store" method="POST">

        @csrf

        <label>Nama Layanan</label>

        <input
            type="text"
            name="service_name"
            required
        >

        <button class="btn" type="submit">
            Simpan
        </button>

    </form>

</div>

@endsection