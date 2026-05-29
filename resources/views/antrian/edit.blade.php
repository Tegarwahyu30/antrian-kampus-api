@extends('layouts.app')

@section('content')

<div class="card" style="max-width:700px; margin:auto;">

    <h1>Edit Antrian</h1>

    <br>

    <form
        action="/antrian/update/{{ $antrian->id }}"
        method="POST"
    >

        @csrf

        <label>Nama Mahasiswa</label>

        <input
            type="text"
            name="nama"
            value="{{ $antrian->nama }}"
            required
        >

        <label>NIM</label>

        <input
            type="text"
            name="nim"
            value="{{ $antrian->nim }}"
            required
        >

        <label>Keperluan</label>

        <textarea
            name="keperluan"
            rows="4"
            style="
                width:100%;
                padding:10px;
                margin-top:10px;
                margin-bottom:20px;
            "
            required
        >{{ $antrian->keperluan }}</textarea>

        <label>Pilih Layanan</label>

        <select name="service_id" required>

            @foreach($services as $service)

                <option
                    value="{{ $service->id }}"
                    @if($service->id == $antrian->service_id)
                        selected
                    @endif
                >

                    {{ $service->service_name }}

                </option>

            @endforeach

        </select>

        <label>Tanggal</label>

        <input
            type="date"
            name="queue_date"
            value="{{ $antrian->queue_date }}"
            required
        >

        <label>Status</label>

        <select name="status">

            <option
                value="waiting"
                @if($antrian->status == 'waiting')
                    selected
                @endif
            >
                Waiting
            </option>

            <option
                value="process"
                @if($antrian->status == 'process')
                    selected
                @endif
            >
                Process
            </option>

            <option
                value="done"
                @if($antrian->status == 'done')
                    selected
                @endif
            >
                Done
            </option>

        </select>

        <br><br>

        <button class="btn" type="submit">

            Update

        </button>

    </form>

</div>

@endsection