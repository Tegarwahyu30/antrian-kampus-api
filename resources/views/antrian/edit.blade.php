@extends('layouts.app')

@section('content')

<div class="card" style="max-width:600px; margin:auto;">

    <h1>Edit Antrian</h1>

    <br>

    <form
        action="/antrian/update/{{ $antrian->id }}"
        method="POST"
    >

        @csrf

        <label>Nomor Antrian</label>

        <input
            type="text"
            name="queue_number"
            value="{{ $antrian->queue_number }}"
            required
        >

        <label>Tanggal Antrian</label>

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
                {{ $antrian->status == 'waiting' ? 'selected' : '' }}
            >
                Waiting
            </option>

            <option
                value="done"
                {{ $antrian->status == 'done' ? 'selected' : '' }}
            >
                Done
            </option>

        </select>

        <button class="btn" type="submit">
            Update
        </button>

    </form>

</div>

@endsection