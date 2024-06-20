<?php
// Mendapatkan data yang dikirimkan dari formulir
$nama_lengkap = $_POST['nama_lengkap'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];


$servername = "localhost";
$db_username = "root"; 
$db_password = ""; 
$dbname = "proyek_web"; 

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Buat dan jalankan query SQL untuk menyimpan data ke dalam database
$sql = "INSERT INTO users (nama_lengkap, username, email, password) VALUES ('$nama_lengkap', '$username', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "Registrasi berhasil!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Tutup koneksi ke database
$conn->close();
?>
