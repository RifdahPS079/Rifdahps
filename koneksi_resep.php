<?php
// Mendapatkan data yang dikirimkan dari formulir
$nama_resep = $_POST['recipe-name'];
$kategori = $_POST['recipe-category'];
$bahan_bahan = $_POST['recipe-Bahan-Bahan'];
$langkah_langkah = $_POST['recipe-Langkah-Langkah'];

$servername = "localhost";
$db_username = "root"; 
$db_password = ""; 
$dbname = "proyek_web"; 

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Unggah gambar resep
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["recipe-image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Periksa apakah file gambar valid
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["recipe-image"]["tmp_name"]);
    if($check !== false) {
        echo "File adalah gambar - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File bukan gambar.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Maaf, file tersebut sudah ada.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["recipe-image"]["size"] > 500000) {
    echo "Maaf, file terlalu besar.";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diizinkan.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Maaf, file tidak diunggah.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["recipe-image"]["tmp_name"], $target_file)) {
        echo "File ". htmlspecialchars( basename( $_FILES["recipe-image"]["name"])). " telah diunggah.";
    } else {
        echo "Maaf, terjadi kesalahan saat mengunggah file.";
    }
}

// Buat dan jalankan query SQL untuk menyimpan data ke dalam database
$sql = "INSERT INTO unggah_resep (nama_resep, kategori, bahan_bahan, langkah_langkah, gambar_resep) VALUES ('$nama_resep', '$kategori', '$bahan_bahan', '$langkah_langkah', '$target_file')";

if ($conn->query($sql) === TRUE) {
    echo "Resep berhasil ditambahkan!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Tutup koneksi ke database
$conn->close();
?>

