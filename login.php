<?php
session_start();

$login_success = false;
$login_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // Koneksi ke database (pastikan sesuai dengan konfigurasi database Anda)
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "proyek_web";
    $conn = new mysqli($servername, $db_username, $db_password, $db_name);

    // Memeriksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Query untuk memeriksa apakah username dan password cocok
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Login berhasil
        $login_success = true;

        // Set session variable
        $_SESSION['username'] = $username;

        // Redirect user to index.php or any other desired page
        header("Location: profil.php");
        exit;
    } else {
        $login_error = "Username atau password salah.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
    <div class="form-container">
        <h2>Login</h2>
        
        <?php if ($login_error): ?>
            <div id="error-message">
                <p><?php echo $login_error; ?></p>
            </div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <input type="submit" value="Login">
            
            
            
        </form>
        
        <!-- Add the "Login as Admin" button -->
        <form action="login_admin.php" method="GET">
            <input type="submit" value="Login Sebagai Admin">
            <p>Belum punya akun? <a href="daftar.php">Daftar disini</a></p>
        </form>
    </div>
</body>
</html>


