<!-- Rifdah Pritama Saputri = Membuat hapus_resep -->
<?php
session_start();

// Periksa apakah pengguna sudah login, jika tidak, arahkan ke halaman login
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
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

if (!isset($_GET['id'])) {
    header("Location: resep_saya.php");
    exit;
}

$id = $_GET['id'];

// Hapus resep dari database
$sql_delete = "DELETE FROM unggah_resep WHERE id = '$id'";

if ($conn->query($sql_delete) === TRUE) {
    // Jika penghapusan berhasil, arahkan pengguna kembali ke halaman daftar resep
    header("Location: resep_saya.php");
    exit;
} else {
    echo "Error: " . $sql_delete . "<br>" . $conn->error;
}

$conn->close();
?>
