<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email</title>
    <style>
        body {
            background-color: #f8f9fa; /* Warna latar belakang halaman */
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
        }

        .card {
            width: 50%;
            margin: auto;
            padding: 20px;
            border-radius: 4px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Efek bayangan */
            background-color: #fff; /* Warna latar belakang card */
            text-align: center;
            margin-top: 50px;
        }

        h2 {
            color: #d94f4f; /* Warna teks judul */
        }

        p {
            color: #333; /* Warna teks paragraf */
            margin-top: 20px;
        }

        button {
            background-color: #d94f4f; /* Warna tombol */
            color: #fff; /* Warna teks tombol */
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
        }

        button:hover {
            background-color: #c92c2c; /* Warna tombol saat dihover */
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #d94f4f;
            color: #fff;
        }

        @media only screen and (max-width: 600px) {
            .card {
                width: 80%;
            }

        }
    </style>
</head>
<body>
    <div class="card">
        <h2>Welcome, {{ $details['name']}}!</h2>
        <p>Please click the button below to verify your email and activate your account:</p>
        <button><a href="{{ $details['url']}}" style="text-decoration: none; color:#ffff">Verifikasi</a></button>
        <p>Here is your data:</p>
        <h3>Name : {{ $details['name']}}</h3>
        <h3>Email : {{ $details['email']}}</h3>
        <h3>Date : {{ $details['datetime']}}</h3>
    </div>
</body>
</html>
