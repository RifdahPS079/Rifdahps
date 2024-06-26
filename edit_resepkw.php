<!-- Nada Istiana Habibi = Membuat edit_resepkw.php -->
<?php
// Koneksi ke database
$servername = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "proyek_web";
$conn = new mysqli($servername, $db_username, $db_password, $db_name);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Variabel untuk menyimpan pesan hasil operasi edit
$edit_message = "";

// Periksa apakah ID resep disertakan dalam URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mendapatkan detail resep berdasarkan ID
    $sql = "SELECT * FROM unggah_resep WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $resep = $result->fetch_assoc();
    } else {
        echo "Resep tidak ditemukan";
        exit;
    }
} else {
    echo "ID resep tidak valid";
    exit;
}

// Proses penyimpanan data setelah pengeditan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_resep = $_POST['nama_resep'];
    $kategori = $_POST['kategori'];
    $bahan_bahan = $_POST['bahan_bahan'];
    $langkah_langkah = $_POST['langkah_langkah'];

    // Query untuk melakukan update data resep
    $sql_update = "UPDATE unggah_resep SET nama_resep='$nama_resep', kategori='$kategori', bahan_bahan='$bahan_bahan', langkah_langkah='$langkah_langkah' WHERE id=$id";

    if ($conn->query($sql_update) === TRUE) {
        $edit_message = "Resep berhasil diperbarui.";
        // Mengambil data terbaru setelah update
        $resep['nama_resep'] = $nama_resep;
        $resep['kategori'] = $kategori;
        $resep['bahan_bahan'] = $bahan_bahan;
        $resep['langkah_langkah'] = $langkah_langkah;
    } else {
        $edit_message = "Terjadi kesalahan saat memperbarui resep: " . $conn->error;
    }
}

// Menutup koneksi database
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="edit_resepkw.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Resep - Recipe Website</title>
</head>
<body>
    <header>
        <div class="container"> 
            <h1 class="logo">Edit Resep</h1>
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

    <div class="container mt-4">
        <h2>Detail Resep</h2>
        <?php if ($edit_message): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $edit_message; ?>
            </div>
        <?php endif; ?>

        <form method="post">
            <div class="form-group">
                <label for="nama_resep">Nama Resep:</label>
                <input type="text" class="form-control" id="nama_resep" name="nama_resep" value="<?php echo $resep['nama_resep']; ?>" required>
            </div>
            <div class="form-group">
                <label for="kategori">Kategori:</label>
                <input type="text" class="form-control" id="kategori" name="kategori" value="<?php echo $resep['kategori']; ?>" required>
            </div>
            <div class="form-group">
                <label for="bahan_bahan">Bahan-bahan:</label>
                <textarea class="form-control" id="bahan_bahan" name="bahan_bahan" rows="5" required><?php echo $resep['bahan_bahan']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="langkah_langkah">Langkah-langkah:</label>
                <textarea class="form-control" id="langkah_langkah" name="langkah_langkah" rows="5" required><?php echo $resep['langkah_langkah']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
