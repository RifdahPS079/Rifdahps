<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title><?php echo isset($unggah_resep['nama_resep']) ? $unggah_resep['nama_resep'] : 'Detail Resep'; ?> - Recipe Website</title>
    <title>FoodRecipes</title>
</head>
<body>
    <header>
        <div class="container"> 
            <nav>
                <ul class="nav-log">
                    <li><a href="daftar.php">Daftar</a></li>
                    <li><a href="login.php">Login</a></li>        
                </ul>
            </nav>
            <h1 class="logo">FoodRecipes</h1>
            <nav>
                <ul class="nav-list">
                    <li><a href="index.php">Home</a></li>             
                    <li><a href="tentang.php">Tentang</a></li>
                    <li><a href="unggah_resep.php">Unggah Resep</a></li>
                    <li><a href="profil.php">Profil</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Recipe List Start -->
    <div class="recipe-list">
        <table border="1">
            <tr>
                <td><b>Gambar</b></td>
                <td><b>Judul</b></td>
                <td><b>Kategori</b></td>
                <td><b>Opsi</b></td>
                <td><b>Aksi</b></td>
            </tr>
            <?php
            // Koneksi ke database
            $servername = "localhost";
            $db_username = "root";
            $db_password = "";
            $db_name = "proyek_web";
            $konek = new mysqli($servername, $db_username, $db_password, $db_name);

            // Memeriksa koneksi
            if ($konek->connect_error) {
                die("Koneksi gagal: " . $konek->connect_error);
            }

            // Query untuk menampilkan daftar resep
            error_reporting(0);
            if(isset($_GET['kategori'])){
                $kategori = $_GET['kategori'];
                $query = mysqli_query($konek, "SELECT * FROM unggah_resep WHERE kategori = '$kategori'");
            } else {
                $query = mysqli_query($konek, "SELECT * FROM unggah_resep");
            }

            while($data = mysqli_fetch_array($query)) {
            ?>
                <tr>
                    <td><img src="uploads/<?php echo $data['id_resep']; ?>.jpg" width="500px"></td>
                    <td><?php echo $data['nama_resep']; ?></td>
                    <td><?php echo $data['kategori']; ?></td>
                    <td><?php echo '<a href="detail_resep.php?id=' . $data['id_resep'] . '">Lihat Resep</a>'; ?></td>
                    <td> <a href="edit_resep.php?id_resep=<?php echo $data['id_resep']; ?>" class="btn btn-primary">Edit</a></td>
                    <td> <a href="hapus_resep.php?id_resep=<?php echo $data['id_resep']; ?>" class="btn btn-danger">Hapus</a></td>
                </tr>


            <?php
            }
            $konek->close();
            ?>
        </table>
    </div>
    <!-- Recipe List End -->
</body>
</html>
