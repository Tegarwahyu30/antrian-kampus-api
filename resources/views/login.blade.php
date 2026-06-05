<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>

    <style>

        body{
            margin: 0;
            padding: 0;
            font-family:Arial;
            background:#f4f4f4;
        }

        .box{
            width:400px;
            margin:100px auto;
            background:white;
            padding:30px;
            border-radius:12px;
            box-shadow:0 2px 10px rgba(0,0,0,.1);
            box-sizing: border-box; /* Memastikan boks utama tetap presisi 400px */
        }

        input{
            width:100%;
            padding:12px;
            margin-bottom:15px;
            border:1px solid #ddd;
            box-sizing: border-box; /* KUNCI: Membuat kolom pas di tengah & tidak meluber ke kanan */
        }

        button{
            width:100%;
            padding:12px;
            background:#2563eb;
            color:white;
            border:none;
            cursor:pointer;
            font-weight: bold;
            box-sizing: border-box; /* Membuat tombol sejajar rapi dengan input */
        }

        h2{
            text-align:center;
            margin-top: 0;
            margin-bottom: 20px;
        }

        /* Gaya Kotak Pesan Error Tambahan agar Sangat Rapi */
        .alert-error {
            color: #ef4444;
            background-color: #fee2e2;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
            text-align: center;
            font-weight: bold;
            font-size: 14px;
            border: 1px solid #fca5a5;
            box-sizing: border-box;
        }

    </style>

</head>
<body>

<div class="box">

    <h2>Login Admin</h2>

    @if(session('error'))

        <div class="alert-error">
            {{ session('error') }}
        </div>

    @endif

    <form action="/login" method="POST">

        @csrf

        <input
            type="email"
            name="email"
            placeholder="Email"
            required
        >

        <input
            type="password"
            name="password"
            placeholder="Password"
            required
        >

        <button type="submit">
            Login
        </button>

    </form>

</div>

</body>
</html>