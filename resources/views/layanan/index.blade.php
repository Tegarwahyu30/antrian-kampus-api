<!DOCTYPE html>
<html>
<head>
    <title>Data Layanan</title>

    <style>

        body{
            font-family: Arial;
            background: #f4f4f4;
            padding: 30px;
        }

        .container{
            background: white;
            padding: 20px;
            border-radius: 10px;
        }

        table{
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td{
            border: 1px solid #ddd;
            padding: 12px;
        }

        table th{
            background: #2563eb;
            color: white;
        }

        .btn{
            display: inline-block;
            padding: 10px 15px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

    </style>
</head>
<body>

<div class="container">

    <h1>Data Layanan</h1>

    <br>

    <a href="/layanan/create" class="btn">
        + Tambah Layanan
    </a>

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

    <a href="/layanan/edit/{{ $service->id }}">
        Edit
    </a>

    |

    <a
        href="/layanan/delete/{{ $service->id }}"
        onclick="return confirm('Yakin hapus layanan?')"
    >
        Delete
    </a>

</td>

        </tr>

        @endforeach

    </table>

</div>

</body>
</html>