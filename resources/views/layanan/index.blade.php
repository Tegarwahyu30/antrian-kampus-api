@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Data Layanan</h1>

    <br>

    <div style="margin-bottom: 20px;">
        <a href="/layanan/create" class="btn">
            + Tambah Layanan
        </a>

        <a href="/" class="btn" style="float: right;">
            Kembali
        </a>
        
        <div style="clear: both;"></div>
    </div>

    <table>

        <tr>
            <th>No</th>
            <th>Nama Layanan</th>
            <th>Kode</th>
            <th>Aksi</th>
        </tr>

        @foreach($services as $service)

        <tr>

            <td>{{ $loop->iteration }}</td>

            <td>
                {{ $service->service_name }}
            </td>

            <td>
                {{ $service->service_code }}
            </td>
            <td>

                <a
                    href="/layanan/edit/{{ $service->id }}"
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
                    href="/layanan/delete/{{ $service->id }}"
                    onclick="return confirm('Yakin hapus layanan?')"
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

</div>
@endsection