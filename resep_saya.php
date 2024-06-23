<!-- Nurul Ulmi Mustafa= Membuat Resep_saya.php-->

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
$query = "SELECT * FROM unggah_resep";
if (isset($_GET['kategori'])) {
    $kategori = $_GET['kategori'];
    $query .= " WHERE kategori = '$kategori'";
}
$result = mysqli_query($konek, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <title>Daftar Resep - Recipe Website</title>
</head>
<body>
    <header>
        <div class="container"> 
            <h1 class="logo">Daftar Resep Saya</h1>
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
    <div class="container mt-4">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>No.</th>
                    <th>Nama Kategori</th>
                    <th>Gambar Kategori</th>
                    <th>Detail Resep</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                while($data = mysqli_fetch_array($result)) { ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $data['nama_resep']; ?></td>
                        <td><img src="uploads/<?php echo $data['gambar']; ?>" alt="<?php echo $data['nama_resep']; ?>" width="100"></td>
                        <td><a href="detail_resep.php?id=<?php echo $data['id']; ?>" class="btn btn-info"><i class="fas fa-eye"></i></a></td>
                        <td>
                            <a href="unggah_resep.php?id=<?php echo $data['id']; ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                            <a href="hapus_resep.php?id=<?php echo $data['id']; ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                        </td>
                        
                    </tr>
                <?php } ?>
            </tbody>
        </table>
                <tr>
                    <td><a href="profil.php" class="btn-primary">Kembali ke Daftar Profil</a></td>
                </tr>
    </div>
    <!-- Recipe List End -->

    <?php $konek->close(); ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
