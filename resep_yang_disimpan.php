<!-- Nada Istiana habibi = membuat resep_yang_disimpan.php -->
<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: profil.php');
    exit;
}

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyek_web";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Periksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$user_id = $_SESSION['user_id'];

// Query untuk mendapatkan resep yang disimpan oleh user
$sql = "SELECT unggah_resep.* FROM saved_recipes 
        JOIN unggah_resep ON saved_recipes.recipe_id = unggah_resep.id 
        WHERE saved_recipes.user_id = '$user_id'";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resep_yang_disimpan.css">
    <title>Resep yang Disimpan - Recipe Website</title>
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
        <h1 class="logo">Resep yang Disimpan</h1>
        <nav>
            <ul class="nav-list">
                <li><a href="index.php">Home</a></li>              
                <li><a href="tentang.php">Tentang</a></li>
                <li><a href="unggah_resep.php">Unggah Resep</a></li>
                <li><a href="profil.php">Profil</a></li>
            </ul>
        </nav>
    </div>
</header>

<section class="saved-recipes">
    <h2>Resep yang Disimpan</h2>
    <?php if ($result && mysqli_num_rows($result) > 0): ?>
        <ul>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <li>
                    <a href="detail_resep.php?id=<?php echo $row['id']; ?>">
                        <img src="uploads/<?php echo $row['gambar']; ?>" alt="<?php echo $row['nama_resep']; ?>">
                        <h3><?php echo $row['nama_resep']; ?></h3>
                    </a>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>Belum ada resep yang disimpan.</p>
    <?php endif; ?>
</section>

</body>
</html>

<?php
// Tutup koneksi database
mysqli_close($conn);
?>
