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
            background-color: rgba(232, 197, 185, 0.919);
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
                        <a class="nav-link active text-dark" aria-current="page" href="/homeL">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" aria-current="page" href="/salon/salonPricelistL">Daftar Harga Jasa</a>
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

    <body>

        <div>
            <form method="POST" action="/salon/simpanReservasi" enctype="multipart/form-data">
                <div class="mb-3 mt-3">
                    <?= csrf_field() ?>
                    <h1 style="text-align: center;">Formulir Reservasi</h1><br>
                    <h4>Detail Orderan:</h4><br>
                    <h6>Catatan : Reservasi ini hanya berlaku untuk 1 hari sebelumnya</h6><br>
                    <p>
                        <label for="email">Email:</label>
                        <input placeholder="Masukkan email" class="form-control" type="text" id="email" name="email" value="<?= $session->pengguna ?>">
                    </p>
                    <p>
                        <label for="jasa">Pilih jasa :</label>
                        <select id="jasa" name="jasa" class="form-control">
                            <option value="">Silahkan Pilih</option>
                            <?php foreach ($price_list as $data) { ?>
                                <option value="<?= $data['id_jasa'] ?>"><?= $data['nama_jasa'] . ' ~ ' . $data['harga'] ?></option>
                            <?php } ?>
                        </select>
                    </p>
                    <!-- <p>
                        <label for="waktu">Pilih waktu reservasi :</label><br>
                        <select id="waktu" name="waktu" class="form-control">
                            <option value="10.00 - 12.00 AM">10.00 - 12.00</option>
                            <option value="12.00 - 02.00 PM">12.00 - 02.00</option>
                            <option value="02.00 - 04.00 PM">02.00 - 04.00</option>
                            <option value="04.00 - 06.00 PM">04.00 - 06.00</option>
                        </select>
                    </p> -->
                    <?php
                        // Contoh fungsi untuk mendapatkan informasi slot yang sudah dipesan
                        function getBookedSlots()
                        {
                            // Misalnya, kita menggunakan array untuk menyimpan informasi
                            return [
                                '10.00 - 12.00 AM' => ['booking1', 'booking2'],
                                '12.00 - 02.00 PM' => ['booking3'],
                                // ...
                            ];
                        }

                        // Fungsi ini mengembalikan array yang berisi informasi slot yang sudah dipesan
                        $booked_slots = getBookedSlots();

                        function checkAvailability($timeSlot, $bookedSlots)
                        {
                            $maxSlots = 4; // Jumlah maksimal slot per jam

                            // Logika untuk memeriksa ketersediaan slot
                            if (isset($bookedSlots[$timeSlot]) && count($bookedSlots[$timeSlot]) >= $maxSlots) {
                                return 'disabled';
                            } else {
                                return '';
                            }
                        }
                    ?>
                    <p>
                        <label for="waktu">Pilih waktu reservasi :</label><br>
                        <select id="waktu" name="waktu" class="form-control">
                            <option value="10.00 - 12.00 AM" <?= checkAvailability("10.00 - 12.00 AM", $booked_slots) ?>>10.00 - 12.00</option>
                            <option value="12.00 - 02.00 PM" <?= checkAvailability("12.00 - 02.00 PM", $booked_slots) ?>>12.00 - 02.00</option>
                            <option value="02.00 - 04.00 PM" <?= checkAvailability("02.00 - 04.00 PM", $booked_slots) ?>>02.00 - 04.00</option>
                            <option value="04.00 - 06.00 PM" <?= checkAvailability("04.00 - 06.00 PM", $booked_slots) ?>>04.00 - 06.00</option>
                        </select>
                    </p>
                    <p>
                        <label for="pembayaran">Pilih Metode Pembayaran :</label><br>
                        <select onclick="showPaymentForm()" id="pembayaran" name="pembayaran" class="form-control">
                            <option value="QRIS">QRIS</option>
                            <option value="CASH">Cash</option>
                        </select>
                    </p>
                    <div id="paymentForm" style="display: none;">
                        <p>
                            <img src="/img/qris.png" style="width: 200px; height: 200px; display: block;">
                            <br>
                            <label for=" photo">Upload foto bukti pembayaran:</label><br>
                            <input type="file" id="photo" name="photo" accept="image/*">
                        </p>
                    </div>
                    <p>
                        <button name="submit" type="submit" value="reservasi" class="form-control" style="background-color: #BD7272; color: #fff;">Konfirmasi Reservasi</button>
                    </p>
                </div>
            </form>
        </div>

    </body>
</body>

</html>