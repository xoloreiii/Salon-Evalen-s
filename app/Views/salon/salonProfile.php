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

        form {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        body {
            background-image: url('https://img.freepik.com/free-vector/petals-pink-rose-spa-background_8829-2606.jpg?w=1060&t=st=1701513014~exp=1701513614~hmac=b3ceb943adce20a674cf85ab7916955c737196f57c3f7159b2f2081cb0c69d7e'); 
            background-size: cover; 
            background-position: center;
            height: 100vh;
            margin: 0;
            padding: 0;
        }

        /* Tambahkan gaya CSS khusus untuk tampilan mobile di sini */
        @media screen and (max-width: 768px) {
            .container {
                max-width: 100%;
                padding: 10px;
            }

            /* Contoh pengaturan lain untuk tampilan mobile */
            .navbar-brand img {
                max-width: 50px;
            }
        }
    </style>
    <script>
        function showPaymentForm() {
            var paymentMethod = document.getElementById("pembayaran").value;
            var paymentForm = document.getElementById("paymentForm");

            if (paymentMethod === "QRIS") {
                paymentForm.style.display = "block";
            } else {
                paymentForm.style.display = "none";
            }
        }
    </script>
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
                        <a class="nav-link active text-dark" aria-current="page" href="/homeL">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" aria-current="page" href="/salon/salonPricelistL">Price List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" aria-current="page" href="/salon/simpanReservasi">Reservasi</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"> <img src="/img/profil.png" width="50" height="48"> </a>
                    <ul class="dropdown-menu" style="background-color: #CA9898">
                        <li><a class="dropdown-item" style="color: #000000" href="/salon/profile">Profil</a></li>
                        <li><a class="dropdown-item" style="color: #000000" href="/home">Keluar</a></li>
                    </ul>
                    </li>
                </ul>
                </ul>
            </div>
        </div>
    </nav>

    <!-- <body>

        <div>
            <form method="POST" action="/salon/updateProfile" enctype="multipart/form-data">
                <div class="mb-3 mt-3">
                    <h1 style="text-align: center;">Profile</h1><br>
                    <p>
                        <label for="nama">Nama :</label>
                        <input placeholder="Masukkan nama" class="form-control" type="text" id="nama" name="nama" 
                    </p>
                    <p>
                        <label for="email">Email:</label>
                        <input placeholder="Masukkan email" class="form-control" type="text" id="email" name="email" 
                    </p>
                    <p>
                        <label for="nohp">No Hp :</label>
                        <input placeholder="Masukkan no hp" class="form-control" type="text" id="nohp" name="nohp"
                    </p>
                    
                    <p>
                        <button name="submit" type="submit" value="reservasi" class="form-control" style="background-color: #BD7272; color: #fff;">Update Profile</button>
                    </p>
                </div>
            </form>
        </div>

    </body> -->
    <body>
        <div>
            <form method="POST" action="/salon/updateProfile" enctype="multipart/form-data">
                <div class="mb-3 mt-3">
                    <?= csrf_field() ?>
                    <h1 style="text-align: center;">Profile</h1><br>
                    <p>
                        <label for="nama">Nama :</label>
                        <input placeholder="Masukkan nama" class="form-control" type="text" id="nama" name="nama" value="<?= esc($profile['nama']) ?>" readonly>
                    </p>
                    <p>
                        <label for="email">Email:</label>
                        <input placeholder="Masukkan email" class="form-control" type="text" id="email" name="email" value="<?= esc($profile['email']) ?>" readonly>
                    </p>
                    <p>
                        <label for="nohp">No Hp :</label>
                        <input placeholder="Masukkan no hp" class="form-control" type="text" id="nohp" name="nohp" value="<?= esc($profile['nohp']) ?>" readonly>
                    </p>

                    <br>
                    <h3 style="text-align: center;"> Perbarui Profil</h3>
                    <p>
                        <label for="nama">Nama :</label>
                        <input placeholder="Masukkan nama" class="form-control" type="text" id="nama" name="nama">
                    </p>
                    <p>
                        <label for="email">Email:</label>
                        <input placeholder="Masukkan email" class="form-control" type="text" id="email" name="email" value="<?= session()->get('pengguna') ?>" readonly>
                    </p>
                    <p>
                        <label for="nohp">No Hp :</label>
                        <input placeholder="Masukkan no hp" class="form-control" type="text" id="nohp" name="nohp">
                    </p>
                    <p>
                        <button name="submit" type="submit" value="reservasi" class="form-control" style="background-color: #BD7272; color: #fff;">Perbarui Profil</button>
                    </p>
                </div>
            </form>
        </div>
    </body>



</body>

</html>