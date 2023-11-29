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
</head>

<body>
  <!-- Interface Navbar n TodoList-->
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark shadow" style="background-color: #460456e4">
      <div class="container justify-content-center">
        <a class="navbar-brand" href="todo.php">Praktikum Platform</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="todo.php">To-Do-List</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  <!-- TodoList -->
  <div class="container mt-3">
    <div class="container mt-3">
      <div class="jumbotron text-center ">
        <h1>APLIKASI TO-DO-LIST</h1>
      </div>
      
      <form method="POST" action="todolist/save">
        <div class="mb-3 mt-3">
          <p>
            <label for="kegiatan">Masukkan Kegiatan : </label>
            <br>
            <input class="form-control" type="kegiatan" id="kegiatan"  name="kegiatan"><br>
            <button name = button type="submit" class="btn btn-primary">Tambahkan</button>
          </p>
          <p>
            <br>
            <label for="dafkegiatan">Daftar Kegiatan : </label>

          </p>
        </div>
        
      </form>

    </div>
    
    <?php
        //Connection server
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "tododb";

        //creact connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        //check connection
        if ($conn->connect_error) {
            die("Connection Failed: " . $conn->connect_error);
        }
        
        //Insert data
        if(isset($_POST['button'])) {
            $kegiatan = $_POST['kegiatan'];

            $sql = "INSERT INTO todolist (kegiatan)
                        VALUES ('$kegiatan')";
            $query = mysqli_query($conn, $sql);
        }

        //Update finish
        if (isset($_GET['selesai'])) {
          $id = $_GET['selesai'];
          $sql = "UPDATE todolist SET status='selesai' WHERE idkegiatan=$id";
          if ($conn-> query($sql) === TRUE) {
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
          } else {
            echo "Error updating record: " . $conn->error;
          }
          $query = mysqli_query($conn, $sql);
        }

        //Delete data
        if (isset($_GET['hapus'])) {
          $id = $_GET['hapus'];
          $sql = "DELETE FROM todolist WHERE idkegiatan=$id";
            if ($conn-> query($sql) === TRUE) {
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
          } else {
            echo "Error updating record: " . $conn->error;
          }
          $query = mysqli_query($conn, $sql);
        }

    ?>
    <?php
        // Display list table
        $sql = "SELECT * FROM todolist";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "<table class='table'>";
            echo "<thead><tr><th>Id</th><th>Kegiatan</th><th>Status</th><th> </th></tr></thead>";
            echo "<tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["idkegiatan"] . "</td><td>" . $row["kegiatan"] . "</td><td>" . $row["status"] . "</td><td>";
                echo "<a href='" . $_SERVER['PHP_SELF'] . "?selesai=" . $row["idkegiatan"] . "'>Selesai</a> ";
                echo "<a href='" . $_SERVER['PHP_SELF'] . "?hapus=" . $row["idkegiatan"] . "'>Hapus</a>";
                echo "</td></tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "Tidak ada kegiatan yang tersimpan.";
            $sql = "ALTER TABLE todolist AUTO_INCREMENT = 1";
            $query = mysqli_query($conn, $sql);
        }
        $conn -> close();
?>
</body>

</html>