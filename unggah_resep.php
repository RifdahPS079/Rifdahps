<!-- Rifdah Pritama Saputri = Membuat unggah_resep.php -->
<?php
session_start();

// Check if the username is set in the session
if (!isset($_SESSION['username'])) {
    die("Error: Anda harus login terlebih dahulu.");
}

// Koneksi ke database
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "proyek_web";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$success = false;
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch and sanitize input
    $nama_resep = htmlspecialchars($_POST['recipe-name']);
    $kategori = htmlspecialchars($_POST['recipe-category']);
    $bahan_bahan = htmlspecialchars($_POST['recipe-Bahan-Bahan']);
    $langkah_langkah = htmlspecialchars($_POST['recipe-Langkah-Langkah']);
    $username = $_SESSION['username']; // Fetch username from session

    // Check if uploads directory exists and has write permissions
    if (!is_dir("uploads")) {
        mkdir("uploads", 0777, true);
    }

    if (!is_writable("uploads")) {
        chmod("uploads", 0777);
    }

    // Validate image file type
    $check = getimagesize($_FILES["recipe-image"]["tmp_name"]);
    if ($check !== false) {
        $imageFileType = strtolower(pathinfo($_FILES["recipe-image"]["name"], PATHINFO_EXTENSION));
        $allowed_extensions = array("jpg", "jpeg", "png", "gif");

        if (in_array($imageFileType, $allowed_extensions)) {
            $gambar = basename($_FILES['recipe-image']['name']);
            $target_dir = "uploads/";
            $target_file = $target_dir . $gambar;
            $uploadOk = 1;

            // Check file size (optional, can be adjusted)
            if ($_FILES["recipe-image"]["size"] > 500000) {
                $error = "Maaf, file Anda terlalu besar (maksimal 500KB).";
                $uploadOk = 0;
            }

            // Move uploaded file
            if ($uploadOk == 0) {
                $error = "Maaf, file Anda tidak dapat diunggah.";
            } else {
                if (move_uploaded_file($_FILES["recipe-image"]["tmp_name"], $target_file)) {
                    // Prepare SQL query with placeholders to prevent SQL injection
                    $sql = "INSERT INTO unggah_resep (nama_resep, kategori, bahan_bahan, langkah_langkah, gambar, username) VALUES (?, ?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);

                    // Bind values to placeholders (sanitize data if needed)
                    $stmt->bind_param("ssssss", $nama_resep, $kategori, $bahan_bahan, $langkah_langkah, $gambar, $username);

                    if ($stmt->execute()) {
                        $success = true; 
                    } else {
                        $error = "Error: " . $stmt->error;
                    }

                    $stmt->close();
                } else {
                    $error = "Maaf, terjadi kesalahan saat mengunggah file Anda.";
                }
            }
        } else {
            $error = "Maaf, hanya file JPG, JPEG, PNG, dan GIF yang diizinkan.";
        }
    } else {
        $error = "File bukan gambar.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Resep Makanan</title>
  <link rel="stylesheet" href="unggah_resep.css">
</head>
<body>
  <div class="container">
    <button class="back-btn" onclick="window.history.back()">Kembali</button>
    <div class="add-recipe-form">
      <h2>Tambah Resep Makanan</h2>

      <?php if ($success): ?>
        <div id="success-message">
          <p>Resep Anda berhasil ditambahkan!</p>
        </div>
      <?php elseif ($error): ?>
        <div id="error-message">
          <p><?php echo $error; ?></p>
        </div>
      <?php endif; ?>

      <form id="recipe-form" method="POST" enctype="multipart/form-data">
        <label for="recipe-name">Nama Resep:</label>
        <input type="text" id="recipe-name" name="recipe-name" required>

        <label for="recipe-category">Kategori:</label>
        <select id="recipe-category" name="recipe-category" required>
          <option value="" disabled selected>Pilih kategori</option>
          <option value="makanan">Makanan</option>
          <option value="minuman">Minuman</option>
        </select>

        <label for="recipe-Bahan-Bahan">Bahan-Bahan:</label>
        <textarea id="recipe-Bahan-Bahan" name="recipe-Bahan-Bahan" required></textarea>

        <label for="recipe-Langkah-Langkah">Langkah-Langkah:</label>
        <textarea id="recipe-Langkah-Langkah" name="recipe-Langkah-Langkah" required></textarea>

        <label for="recipe-image">Gambar Resep:</label>
        <input type="file" id="recipe-image" name="recipe-image" accept="image/*" required>

        <button type="submit">Tambah Resep</button>
      </form>
    </div>
  </div>
</body>
</html>