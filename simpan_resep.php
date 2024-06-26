<!-- Nurul Ulmi Mustafa= Membuat simpan_resep.php-->
<?php
session_start();

if (!isset($_SESSION['username'])) {
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

// Get the user ID
$user_sql = "SELECT id FROM users WHERE username = '$username'";
$user_result = $conn->query($user_sql);
if ($user_result->num_rows > 0) {
    $user_row = $user_result->fetch_assoc();
    $user_id = $user_row['id'];
} else {
    die("User tidak ditemukan.");
}

// Get saved recipes for the user
$sql = "SELECT sr.id, ur.nama_resep, ur.detail_resep, sr.disimpan 
        FROM simpan_resep sr 
        JOIN unggah_resep ur ON sr.resep_id = ur.id 
        WHERE sr.user_id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Pernyataan SQL gagal dipersiapkan: " . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Resep Disimpan</title>
    <link rel="stylesheet" href="style.css"> <!-- Add a stylesheet if needed -->
</head>
<body>
    <header>
        <div class="container">
            <h1 class="logo">FoodRecipes</h1>
        </div>
    </header>
    
    <div class="container">
        <h1>Daftar Resep yang Disimpan</h1>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Resep</th>
                    <th>Detail Resep</th>
                    <th>Waktu Disimpan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Output data untuk setiap baris
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . htmlspecialchars($row["nama_resep"]) . "</td>";
                        echo "<td>" . nl2br(htmlspecialchars($row["detail_resep"])) . "</td>";
                        echo "<td>" . $row["disimpan"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Tidak ada resep yang disimpan.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <button onclick="window.location.href='index.php'">Kembali ke Halaman Utama</button>
    </div>
</body>
</html>

<?php
// Menutup statement dan koneksi
$stmt->close();
$conn->close();
?>
