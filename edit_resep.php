<!-- /* Rifdah Pritama Saputri= membuat edit.php */ -->
 
<?php
session_start();

// Periksa apakah pengguna sudah login, jika tidak, arahkan ke halaman login
if (!isset($_SESSION['user_id'])) {
    header('Location: unggah_resep.php');
    exit;
}

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

$id_resep = isset($_GET['id_resep']) ? $_GET['id_resep'] : null;
$user_id = $_SESSION['user_id'];

$nama_resep = "";
$kategori = "";
$bahan_bahan = "";
$langkah_langkah = "";

if ($id_resep) {
    // Ambil data resep dari database
    $sql = "SELECT * FROM unggah_resep WHERE id_resep = '$id_resep' AND user_id = '$user_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nama_resep = $row['nama_resep'];
        $kategori = $row['kategori'];
        $bahan_bahan = $row['bahan_bahan'];
        $langkah_langkah = $row['langkah_langkah'];
    } else {
        // Jika tidak ada resep dengan ID yang diberikan atau resep tersebut bukan milik user yang login, arahkan pengguna kembali ke halaman resep_saya
        header("Location: resep_saya.php");
        exit;
    }
}

// Proses formulir tambah/edit resep
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lakukan validasi data jika diperlukan
    
    // Ambil data dari formulir
    $nama_resep = $_POST['nama_resep'];
    $kategori = $_POST['kategori'];
    $bahan_bahan = $_POST['bahan_bahan'];
    $langkah_langkah = $_POST['langkah_langkah'];

    if ($id_resep) {
        // Update data resep ke database
        $sql_update = "UPDATE unggah_resep SET nama_resep = '$nama_resep', kategori = '$kategori', bahan_bahan = '$bahan_bahan', langkah_langkah = '$langkah_langkah' WHERE id_resep = '$id_resep' AND user_id = '$user_id'";
        
        if ($conn->query($sql_update) === TRUE) {
            // Jika update berhasil, arahkan pengguna kembali ke halaman resep_saya
            header("Location: resep_saya.php");
            exit;
        } else {
            echo "Error: " . $sql_update . "<br>" . $conn->error;
        }
    } else {
        // Tambah resep baru ke database
        $sql_insert = "INSERT INTO unggah_resep (user_id, nama_resep, kategori, bahan_bahan, langkah_langkah) VALUES ('$user_id', '$nama_resep', '$kategori', '$bahan_bahan', '$langkah_langkah')";
        
        if ($conn->query($sql_insert) === TRUE) {
            // Jika insert berhasil, arahkan pengguna kembali ke halaman resep_saya
            header("Location: resep_saya.php");
            exit;
        } else {
            echo "Error: " . $sql_insert . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title><?php echo $id_resep ? 'Edit Resep' : 'Tambah Resep'; ?></title>
</head>
<body>
    <header>
        <div class="container"> 
            <h1 class="logo">FoodRecipes</h1>
        </div>
    </header>

    <div class="container">
        <h2><?php echo $id_resep ? 'Edit Resep' : 'Tambah Resep'; ?></h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . ($id_resep ? '?id_resep=' . $id_resep : ''); ?>">
            <div class="form-group">
                <label for="nama_resep">Nama Resep:</label>
                <input type="text" name="nama_resep" value="<?php echo htmlspecialchars($nama_resep); ?>" required>
            </div>
            <div class="form-group">
                <label for="kategori">Kategori:</label>
                <input type="text" name="kategori" value="<?php echo htmlspecialchars($kategori); ?>" required>
            </div>
            <div class="form-group">
                <label for="bahan_bahan">Bahan-bahan:</label>
                <textarea name="bahan_bahan" required><?php echo htmlspecialchars($bahan_bahan); ?></textarea>
            </div>
            <div class="form-group">
                <label for="langkah_langkah">Langkah-langkah:</label>
                <textarea name="langkah_langkah" required><?php echo htmlspecialchars($langkah_langkah); ?></textarea>
            </div>
            <button type="submit"><?php echo $id_resep ? 'Simpan Perubahan' : 'Tambah Resep'; ?></button>
        </form>
    </div>
</body>
</html>
