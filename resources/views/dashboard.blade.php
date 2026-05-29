@extends('layouts.app')

@section('content')

<h1>Dashboard Admin</h1>

<br>

<!-- CARD STATISTIK -->
<div style="
    display:grid;
    grid-template-columns:repeat(auto-fit, minmax(220px,1fr));
    gap:20px;
">

    <!-- TOTAL ANTRIAN -->
    <div style="
        background:white;
        padding:25px;
        border-radius:16px;
        box-shadow:0 2px 10px rgba(0,0,0,0.08);
        border-left:6px solid #2563eb;
    ">

        <h2 style="
            margin:0;
            font-size:40px;
            color:#2563eb;
        ">
            {{ $totalAntrian }}
        </h2>

        <p style="
            margin-top:10px;
            color:#555;
            font-size:18px;
        ">
            Total Antrian
        </p>

    </div>

    <!-- WAITING -->
    <div style="
        background:white;
        padding:25px;
        border-radius:16px;
        box-shadow:0 2px 10px rgba(0,0,0,0.08);
        border-left:6px solid orange;
    ">

        <h2 style="
            margin:0;
            font-size:40px;
            color:orange;
        ">
            {{ $waiting }}
        </h2>

        <p style="
            margin-top:10px;
            color:#555;
            font-size:18px;
        ">
            Waiting
        </p>

    </div>

    <!-- PROCESS -->
    <div style="
        background:white;
        padding:25px;
        border-radius:16px;
        box-shadow:0 2px 10px rgba(0,0,0,0.08);
        border-left:6px solid #2563eb;
    ">

        <h2 style="
            margin:0;
            font-size:40px;
            color:#2563eb;
        ">
            {{ $process }}
        </h2>

        <p style="
            margin-top:10px;
            color:#555;
            font-size:18px;
        ">
            Process
        </p>

    </div>

    <!-- DONE -->
    <div style="
        background:white;
        padding:25px;
        border-radius:16px;
        box-shadow:0 2px 10px rgba(0,0,0,0.08);
        border-left:6px solid green;
    ">

        <h2 style="
            margin:0;
            font-size:40px;
            color:green;
        ">
            {{ $done }}
        </h2>

        <p style="
            margin-top:10px;
            color:#555;
            font-size:18px;
        ">
            Done
        </p>

    </div>

    <!-- TOTAL LAYANAN -->
    <div style="
        background:white;
        padding:25px;
        border-radius:16px;
        box-shadow:0 2px 10px rgba(0,0,0,0.08);
        border-left:6px solid purple;
    ">

        <h2 style="
            margin:0;
            font-size:40px;
            color:purple;
        ">
            {{ $totalLayanan }}
        </h2>

        <p style="
            margin-top:10px;
            color:#555;
            font-size:18px;
        ">
            Total Layanan
        </p>

    </div>

</div>


<!-- JARAK -->
<br><br>


<!-- ANTRIAN TERBARU -->
<div style="
    background:white;
    padding:25px;
    border-radius:16px;
    box-shadow:0 2px 10px rgba(0,0,0,0.08);
">

    <h2>
        Antrian Terbaru
    </h2>

    <br>

    <table>

        <tr>

            <th>No</th>

            <th>Nama</th>

            <th>Layanan</th>

            <th>Nomor</th>

            <th>Status</th>

        </tr>

        @foreach($latestAntrians as $antrian)

        <tr>

            <td>
                {{ $loop->iteration }}
            </td>

            <td>
                {{ $antrian->nama }}
            </td>

            <td>
                {{ $antrian->service->service_name }}
            </td>

            <td>
                {{ $antrian->queue_number }}
            </td>

            <td>

                @if($antrian->status == 'waiting')

                    <span style="
                        background:orange;
                        color:white;
                        padding:6px 14px;
                        border-radius:20px;
                        font-size:14px;
                    ">
                        Waiting
                    </span>

                @elseif($antrian->status == 'process')

                    <span style="
                        background:#2563eb;
                        color:white;
                        padding:6px 14px;
                        border-radius:20px;
                        font-size:14px;
                    ">
                        Process
                    </span>

                @elseif($antrian->status == 'done')

                    <span style="
                        background:green;
                        color:white;
                        padding:6px 14px;
                        border-radius:20px;
                        font-size:14px;
                    ">
                        Done
                    </span>

                @endif

            </td>

        </tr>

        @endforeach

    </table>

</div>

<br><br>

<div style="
    background:white;
    padding:25px;
    border-radius:16px;
    box-shadow:0 2px 10px rgba(0,0,0,0.08);
">

    <h2>
        Statistik Layanan
    </h2>

    <br>

    <table>

        <tr>

            <th>No</th>

            <th>Nama Layanan</th>

            <th>Total Antrian</th>

        </tr>

        @foreach($serviceStats as $service)

        <tr>

            <td>
                {{ $loop->iteration }}
            </td>

            <td>
                {{ $service->service_name }}
            </td>

            <td>
                {{ $service->antrians_count }}
            </td>

        </tr>

        @endforeach

    </table>

</div>

<br><br>

<div style="
    background:white;
    padding:25px;
    border-radius:16px;
    box-shadow:0 2px 10px rgba(0,0,0,0.08);
">

    <h2>
        Grafik Antrian Per Layanan
    </h2>

    <br>

    <canvas id="myChart"></canvas>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('myChart');

new Chart(ctx, {

    type: 'bar',

    data: {

        labels: [

            @foreach($serviceStats as $service)

                '{{ $service->service_name }}',

            @endforeach

        ],

        datasets: [{

            label: 'Total Antrian',

            data: [

                @foreach($serviceStats as $service)

                    {{ $service->antrians_count }},

                @endforeach

            ],

            borderWidth: 1

        }]

    },

    options: {

        responsive: true,

        scales: {

            y: {

                beginAtZero: true

            }

        }

    }

});

</script>

@endsection