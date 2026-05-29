@extends('layouts.app')

@section('content')

<h1>Data Antrian</h1>

<br>

<div style="
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
    flex-wrap:wrap;
">

    <!-- BUTTON -->
    <a
        href="/antrian/create"
        class="btn"
    >
        + Tambah Antrian
    </a>

    <!-- SEARCH -->
    <form
        action="/antrian"
        method="GET"
        style="
            display:flex;
            gap:10px;
            align-items:center;
        "
    >

        <input
            type="text"
            name="search"
            placeholder="Cari..."
            value="{{ request('search') }}"
            style="
                padding:10px;
                border:1px solid #ccc;
                border-radius:8px;
                width:180px;
            "
        >

        <select
            name="service_id"
            style="
                padding:10px;
                border:1px solid #ccc;
                border-radius:8px;
            "
        >

            <option value="">
                Semua Layanan
            </option>

            @foreach($services as $service)

                <option
                    value="{{ $service->id }}"
                    {{ request('service_id') == $service->id ? 'selected' : '' }}
                >

                    {{ $service->service_name }}

                </option>

            @endforeach

        </select>

        <select
            name="status"
            style="
                padding:10px;
                border:1px solid #ccc;
                border-radius:8px;
            "
        >

            <option value="">
                Semua Status
            </option>

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

        <button
            type="submit"
            class="btn"
        >
            Search
        </button>

    </form>

</div>

<table>

    <tr>

        <th>No</th>

        <th>Nama</th>

        <th>NIM</th>

        <th>Layanan</th>

        <th>Nomor</th>

        <th>Status</th>

        <th>Tanggal</th>

        <th>Aksi</th>

    </tr>

    @foreach($antrians as $antrian)

    <tr>

        <td>{{ $loop->iteration }}</td>

        <td>{{ $antrian->nama }}</td>

        <td>{{ $antrian->nim }}</td>

        <td>
            {{ $antrian->service->service_name }}
        </td>

        <td>{{ $antrian->queue_number }}</td>

        <td>

    @if($antrian->status == 'waiting')

        <a
            href="/antrian/status/{{ $antrian->id }}"
            style="
                background:orange;
                color:white;
                padding:6px 14px;
                border-radius:20px;
                text-decoration:none;
                display:inline-block;
            "
        >
            Waiting
        </a>

    @elseif($antrian->status == 'process')

        <a
            href="/antrian/status/{{ $antrian->id }}"
            style="
                background:#2563eb;
                color:white;
                padding:6px 14px;
                border-radius:20px;
                text-decoration:none;
                display:inline-block;
            "
        >
            Process
        </a>

    @else

        <span
            style="
                background:green;
                color:white;
                padding:6px 14px;
                border-radius:20px;
                display:inline-block;
            "
        >
            Done
        </span>

    @endif

</td>

</td>

        <td>{{ $antrian->queue_date }}</td>

        <td>

    <a
        href="/antrian/edit/{{ $antrian->id }}"
        style="
            background:#2563eb;
            color:white;
            padding:8px 14px;
            border-radius:8px;
            text-decoration:none;
            margin-right:5px;
        "
    >
        Edit
    </a>

    <a
        href="/antrian/delete/{{ $antrian->id }}"
        onclick="return confirm('Yakin hapus data?')"
        style="
            background:red;
            color:white;
            padding:8px 14px;
            border-radius:8px;
            text-decoration:none;
        "
    >
        Delete
    </a>

</td>

    </tr>

    @endforeach

</table>

@endsection