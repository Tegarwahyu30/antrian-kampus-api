@extends('layouts.app')

@section('content')

<div class="card" style="max-width:600px; margin:auto;">

    <h1>Edit Layanan</h1>

    <br>

    <form
        action="/layanan/update/{{ $service->id }}"
        method="POST"
    >

        @csrf

        <label>Nama Layanan</label>

        <input
            type="text"
            name="service_name"
            value="{{ $service->service_name }}"
            required
        >

        <button class="btn" type="submit">
            Update
        </button>

    </form>

</div>

@endsection