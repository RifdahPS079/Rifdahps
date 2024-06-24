<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit;
}

$servername = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "proyek_web";
$conn = new mysqli($servername, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$username = $_SESSION['username'];
$sql = "SELECT nama_lengkap, username, email, foto_profil FROM users WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    $user = array(
        'nama_lengkap' => 'Nama Admin',
        'username' => 'AdminUsername',
        'email' => 'AdminEmail',
        'foto_profil' => 'default.jpg' // Default profile picture
    );
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle file upload
    if(isset($_FILES['profile-image'])) {
        $file_name = $_FILES['profile-image']['name'];
        $file_tmp = $_FILES['profile-image']['tmp_name'];
        move_uploaded_file($file_tmp, "uploads/".$file_name);

        // Update the profile picture in the database
        $sql_update = "UPDATE users SET foto_profil='$file_name' WHERE username='$username'";
        if ($conn->query($sql_update) === TRUE) {
            // Update successful
            $user['foto_profil'] = $file_name;
        } else {
            echo "Error updating record: " . $conn->error;
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
    <link rel="stylesheet" href="prof.css">
    <title>Recipe Website - Admin Profil</title>
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
            <h1 class="logo">FoodRecipes</h1>
            <nav>
                <ul class="nav-list">
                    <li><a href="index.php">Home</a></li>  
                    <li><a href="kelolah_resep.php">Kelola Resep</a></li>           
                    <li><a href="profil_admin.php">Profil Admin</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="profile-container">
        <button class="back-btn" onclick="window.history.back()">Kembali</button>
        <h2>Profil Admin</h2>
        
        <img src="uploads/<?php echo $user['foto_profil']; ?>" alt="Foto Profil" class="profile-picture" id="profile-pic">
        <form action="profil_admin.php" method="POST" enctype="multipart/form-data">
            <input type="file" id="profile-image" name="profile-image" accept="image/*">
            <button type="submit" class="edit-btn">Simpan Foto</button>
        </form>
        
        <div class="profile-info">
            <label>Nama Lengkap:</label>
            <p><?php echo $user['nama_lengkap']; ?></p>
        </div>
        <div class="profile-info">
            <label>Username:</label>
            <p><?php echo $user['username']; ?></p>
        </div>
        <div class="profile-info">
            <label>Email:</label>
            <p><?php echo $user['email']; ?></p>
        </div>
        
        <button class="manage-recipes-btn" onclick="window.location.href='kelolah_resep.php'">Kelola Resep</button>
    </div>

    <script>
    function uploadProfileImage() {
      const fileInput = document.getElementById('profile-image');
      const file = fileInput.files[0];
      const reader = new FileReader();

      reader.onload = function(event) {
        document.getElementById("profile-pic").src = event.target.result;
      };

      if (file) {
        reader.readAsDataURL(file);
      } else {
        alert('Silakan pilih file gambar.');
      }
    }
    </script>
</body>
</html>
