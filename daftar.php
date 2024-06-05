<?php
// Mengambil data dari form
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$dbname = "projek_web";

// Enkripsi password sebelum menyimpan ke database (disarankan menggunakan fungsi hash seperti bcrypt)
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Koneksi ke database (sesuaikan dengan detail koneksi Anda)
$servername = "localhost";
$username_db = "username_database";
$password_db = "password_database";
$database = "nama_database";

// Membuat koneksi
$conn = new mysqli($servername, $username_db, $password_db, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menyiapkan statement SQL untuk menyimpan data ke dalam database
$sql = "INSERT INTO aftar_akun (Username, Email, Password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $username, $email, $hashedPassword);

// Menjalankan statement SQL
if ($stmt->execute()) {
    echo "Akun berhasil dibuat.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Menutup koneksi ke database
$conn->close();
?>
