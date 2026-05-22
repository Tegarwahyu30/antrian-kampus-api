@extends('layouts.app')

@section('content')

<h1>Dashboard</h1>

<br>

<div style="display:flex; gap:20px;">

    <div 
        class="card"
        style="
            flex:1;
            background:#2563eb;
            color:white;
        "
    >

        <h2>Total Antrian</h2>

        <h1 style="font-size:50px;">
            {{ \App\Models\Antrian::count() }}
        </h1>

    </div>

    <div 
        class="card"
        style="
            flex:1;
            background:#16a34a;
            color:white;
        "
    >

        <h2>Total Layanan</h2>

        <h1 style="font-size:50px;">
            {{ \App\Models\Service::count() }}
        </h1>

    </div>

</div>

@endsection