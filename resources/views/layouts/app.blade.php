<!DOCTYPE html>
<html>
<head>
    <title>Layanan Antrian Kampus</title>

    <style>

        body{
            margin: 0;
            font-family: Arial;
            background: #f4f4f4;
        }

        .navbar{
        background: #2563eb;
        padding: 18px 30px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar a{
            color: white;
            text-decoration: none;
            margin-right: 20px;
            font-weight: bold;
        }

        .container{
            padding: 30px;
        }

        table{
            width: 100%;
            border-collapse: collapse;
            background: white;
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
        table tr:nth-child(even){
        background: #f9fafb;
        }

        table tr:hover{
        background: #f1f5f9;
        }

        .btn{
        display: inline-block;
        padding: 10px 18px;
        background: #2563eb;
        color: white;
        text-decoration: none;
        border-radius: 8px;
        transition: 0.3s;
        }

        .btn:hover{
        background: #1d4ed8;
        }

        input,
        select{
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .card{
         background: white;
         padding: 20px;
         border-radius: 10px;
         margin-bottom: 20px;
         box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .action-edit{
        color: #2563eb;
        text-decoration: none;
        font-weight: bold;
        }

        .action-delete{
        color: red;
        text-decoration: none;
        font-weight: bold;
        }

    </style>
</head>
<body>

<div class="navbar">

    <a href="/">
        Dashboard
    </a>

    <a href="/antrian">
        Data Antrian
    </a>

    <a href="/layanan">
        Data Layanan
    </a>

</div>

<div class="container">

    @yield('content')

</div>

</body>
</html>