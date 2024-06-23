<!-- Nurul Ulmi Mustafa= Membuat daftar.php-->
 
<!DOCTYPE html>
<html>
<head>
    <title>Registrasi</title>
    <link rel="stylesheet" type="text/css" href="daftar.css">
</head>
<body>
    <div class="form-container">
        <h2>Registrasi</h2>
        <?php
        $success = false;
        $error = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Mengambil data dari form
            $nama_lengkap = $_POST['Nama_Lengkap'];
            $username = $_POST['username'];
            $email = $_POST['email'];
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

            // Query untuk memasukkan data pengguna ke dalam tabel pengguna
            $sql = "INSERT INTO users (nama_lengkap, username, email, password) VALUES ('$nama_lengkap', '$username', '$email', '$password')";

            if ($conn->query($sql) === TRUE) {
                $success = true;
            } else {
                $error = "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        }
        ?>

        <?php if ($success): ?>
            <div id="success-message">
                <p>Pendaftaran berhasil!</p>
            </div>
        <?php elseif ($error): ?>
            <div id="error-message">
                <p><?php echo $error; ?></p>
            </div>
        <?php endif; ?>

        <form action="daftar.php" method="POST">
            <label for="Nama_Lengkap">Nama Lengkap:</label>
            <input type="text" id="Nama_Lengkap" name="Nama_Lengkap" required>
            
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <input type="submit" value="daftar">
            
            
            <p>Sudah punya akun? <a href="login.php">Login disini</a></p>
        </form>
    </div>
</body>
</html>
