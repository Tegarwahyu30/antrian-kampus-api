@extends('layouts.app')

@section('content')

<h1>Data Antrian</h1>

<br>

<a href="/antrian/create" class="btn">
    + Tambah Antrian
</a>

<br><br>

<table>

    <tr>
        <th>No</th>
        <th>Nomor</th>
        <th>Status</th>
        <th>Tanggal</th>
        <th>Aksi</th>
    </tr>

    @foreach($antrians as $antrian)

    <tr>

        <td>{{ $loop->iteration }}</td>

        <td>{{ $antrian->queue_number }}</td>

        <td>{{ $antrian->status }}</td>

        <td>{{ $antrian->queue_date }}</td>

        <td>

            <a
            href="/antrian/edit/{{ $antrian->id }}"
            class="action-edit"
            >
            Edit
            </a>

            |

            <a
            class="action-delete"
            href="/antrian/delete/{{ $antrian->id }}"
            onclick="return confirm('Yakin hapus data?')"
            >
            Delete
            </a>

        </td>

    </tr>

    @endforeach

</table>

@endsection