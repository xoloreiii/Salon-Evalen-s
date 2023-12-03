<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    </script>
    <style>
        .jumbotron {
            padding: 3rem 1rem;
        }

        .navbar .navbar-nav .nav-link:hover {
            background: rgba(202, 152, 152, 1);
            border-radius: 6px;
        }

        nav ul li a:hover {
            background: rgba(130, 38, 126, 0.7);
            border-radius: 6px;
        }

        h2 {
            text-align: center;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            text-align: center;
        }

        td, th {
            border: 1px solid #000000;
            text-align: left;
            padding: 5px;
        }

        tr:nth-child(even) {
            background-color: #dddddd; /* putih untuk baris genap */
        }

        tr:nth-child(odd) {
            background-color: #ffc0cb; /* pink untuk baris ganjil */
        }


        body {
            background-image: url('https://img.freepik.com/free-vector/petals-pink-rose-spa-background_8829-2606.jpg?w=1060&t=st=1701513014~exp=1701513614~hmac=b3ceb943adce20a674cf85ab7916955c737196f57c3f7159b2f2081cb0c69d7e'); 
            background-size: cover; 
            background-position: center;
            height: 100vh;
            margin: 0;
            padding: 0;
        }


    </style>
</head>

<body>
    <!-- Interface Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light shadow" style="background-color: #FFFFFF">
        <div class="container justify-content-center">
            <a class="navbar-brand"><img src="/img/salon.png" width="80" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-dark" aria-current="page" href="/home">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" aria-current="page" href="/salon/salonPricelist">Daftar Harga Jasa</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-dark" aria-current="page" href="/salon/salonLogin">Masuk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" aria-current="page" href="/salon/salonRegister">Daftar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Price List  -->

    <body>
        <br><br><br>
        <div class="outer-wrapper">
            <div class="table-wrapper">
                <div class="container">
                    <table>
                        <tr>
                            <!-- <th class="center">No</th> -->
                            <th class="center">Id</th>
                            <th class="center">Nama Jasa</th>
                            <th class="center">Harga</th>

                        </tr>
                        <?php
                        foreach ($body as $bod) : ?>
                            <tr>
                                <td><?= $bod['id_jasa'] ?></td>
                                <td><?= $bod['nama_jasa'] ?></td>
                                <td><?= $bod['harga'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>s
    </body>

</html>