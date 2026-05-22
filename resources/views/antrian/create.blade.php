@extends('layouts.app')

@section('content')

<div class="card" style="max-width:600px; margin:auto;">

    <h1>Tambah Antrian</h1>

    <br>

    <form action="/antrian/store" method="POST">

        @csrf

        <label>Nomor Antrian</label>

        <input
            type="text"
            name="queue_number"
            required
        >

        <label>Tanggal Antrian</label>

        <input
            type="date"
            name="queue_date"
            required
        >

        <label>Status</label>

        <select name="status">

            <option value="waiting">
                Waiting
            </option>

            <option value="done">
                Done
            </option>

        </select>

        <button class="btn" type="submit">
            Simpan
        </button>

    </form>

</div>

@endsection