<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyek_web";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Periksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Periksa apakah ID unggah_resep disertakan dalam URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mendapatkan detail unggah_resep berdasarkan ID
    $sql = "SELECT * FROM unggah_resep WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // Ambil data unggah_resep dari hasil query
        $unggah_resep = mysqli_fetch_assoc($result);
    } else {
        echo "Resep tidak ditemukan";
        exit;
    }
} else {
    echo "ID unggah_resep tidak valid";
    exit;
}

// Tutup koneksi database
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="detail_resep.css">
    <title><?php echo isset($unggah_resep['nama_resep']) ? $unggah_resep['nama_resep'] : 'Detail Resep'; ?> - Recipe Website</title>
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
            <h1 class="logo">Detail Resep</h1>
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

    <section class="recipe-detail">
        <?php if (isset($unggah_resep)): ?>
            <h1><?php echo $unggah_resep['nama_resep']; ?></h1>
            <img src="uploads/<?php echo $unggah_resep['gambar']; ?>" alt="<?php echo $unggah_resep['nama_resep']; ?>">
            <p><?php echo $unggah_resep['kategori']; ?></p>
            <h2>Bahan-bahan:</h2>
            <p><?php echo nl2br($unggah_resep['bahan_bahan']); ?></p>
            <h2>Langkah-langkah:</h2>
            <p><?php echo nl2br($unggah_resep['langkah_langkah']); ?></p>
            
            <a href="simpan_resep.php" class="btn-primary">Simpan Resep</a>
            <a href="index.php" class="btn-primary">Kembali ke Daftar Resep</a>
        <?php else: ?>
            <p>Resep tidak ditemukan</p>
        <?php endif; ?>
    </section>

    <footer>
        <div>
            <p>&copy; 2024 Project WEB</p>
        </div>  
    </footer>
</body>
</html>
