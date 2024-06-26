<!-- Nurul Ulmi Mustafa= Membuat Login.php-->
<?php
session_start();
require 'db_connection.php'; // Include the database connection script

$login_success = false;
$login_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // Koneksi ke database
    $conn = getDbConnection();

    // Query untuk memeriksa apakah username dan password cocok
    $sql = "SELECT * FROM users WHERE username=? AND password=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Login berhasil
        $login_success = true;

        // Ambil data user
        $user = $result->fetch_assoc();

        // Set session variable
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $user['role'];

        // Redirect user based on role
        if ($user['role'] == 'admin') {
            header("Location: profil_admin.php");
        } else {
            header("Location: profil.php");
        }
        exit;
    } else {
        $login_error = "Username atau password salah.";
    }

    $stmt->close();
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

        <p>Belum punya akun? <a href="daftar.php">Daftar disini</a></p>
    </div>
</body>
</html>