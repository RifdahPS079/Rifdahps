<!-- Rifdah Pritama Saputri = Membuat detail_resep -->
<?php
session_start();

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

// Proses penyimpanan resep oleh user
$saved_message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['simpan_resep'])) {
    if (!isset($_SESSION['user_id'])) {
        exit;
    }

    $user_id = $_SESSION['user_id'];
    $resep_id = $id;

    // Periksa apakah resep sudah disimpan oleh user ini
    $check_sql = "SELECT * FROM saved_recipes WHERE user_id = '$user_id' AND recipe_id = '$resep_id'";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        $saved_message = "Resep ini sudah pernah disimpan.";
    } else {
        $sql_simpan = "INSERT INTO saved_recipes (user_id, recipe_id) VALUES ('$user_id', '$resep_id')";
        if (mysqli_query($conn, $sql_simpan)) {
            $saved_message = "Resep berhasil disimpan.";
        } else {
            $saved_message = "Terjadi kesalahan: " . mysqli_error($conn);
        }
    }

    // Redirect kembali ke halaman detail resep
    header("Location: detail_resep.php?id=$resep_id&message=" . urlencode($saved_message));
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
        
        <?php if (isset($_GET['message'])): ?>
            <p><?php echo urldecode($_GET['message']); ?></p>
        <?php endif; ?>

        <form method="post">
            <button type="submit" name="simpan_resep" class="btn-primary">Simpan Resep</button>
        </form>
        <a href="index.php" class="btn-primary">Kembali ke Daftar Resep</a>
    <?php else: ?>
        <p>Resep tidak ditemukan</p>
    <?php endif; ?>
</section>

<!-- <footer>
    <div>
        <p>&copy; 2024 Project WEB</p>
    </div>  
</footer> -->
</body>
</html>
