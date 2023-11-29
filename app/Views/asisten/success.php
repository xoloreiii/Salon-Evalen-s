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
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    .jumbotron {
        padding: 3rem 1rem;
    }
    .navbar .navbar-nav .nav-link:hover {
        background: rgba(130, 38, 126, 0.7);
        border-radius: 6px;
    }
    nav ul li a:hover {
        background: rgba(130, 38, 126, 0.7);
        border-radius: 6px;
    }
  </style>
</head>
 
<body>
  <!-- Interface Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark shadow" style="background-color: #460456e4">
      <div class="container justify-content-center">
        <a class="navbar-brand">Praktikum Platform <img src="/img/cat.png" width="50" alt=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="/asisten/login">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="/asisten/simpan">Simpan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="/asisten/update">Update</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="/asisten/delete">Delete</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="/asisten/search">Search</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="/asisten">Tabel</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="/asisten/logout">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  <!-- Tampilan Success -->
  <div class="container mt-3">
    <div class="container mt-3">
      <div class="jumbotron text-left ">
        <br>
        <h2>Data sukses ditambahkan  </h2><br>
      </div>
    </div>
</body>
</html>