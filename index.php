<?php
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

// Ambil data dari database dan tampilkan
$sql = "SELECT * FROM unggah_resep";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Recipe Website - By Web Coding</title>
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
                    <li><a href="tentang.php">Tentang</a></li>
                    <li><a href="unggah_resep.php">Unggah Resep</a></li>
                    <li><a href="profil.php">Profil</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="hero-section">
            <h2>Selamat Datang Di Dunia Resep</h2>
            <p>Temukan Resep Yang Kamu Inginkan</p>

            <form action="#" class="search-box">
                <input type="text" placeholder="Cari Resep">
                <button type="submit">Cari</button>
            </form>
        </div>
    </section>

    <section class="recipes">
        <h1>KUMPULAN RESEP</h1>
        <div class="recipe-section">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="recipe-card">';
                    echo '<img src="uploads/' . $row['gambar'] . '" alt="' . $row['nama_resep'] . '">';
                    echo '<h2>' . $row['nama_resep'] . '</h2>';
                    echo '<a href="detail_resep.php?id=' . $row['id'] . '">Lihat Resep</a>';
                    echo '</div>';
                }
            } else {
                echo "Tidak ada resep yang ditemukan";
            }
            ?>
        </div>
    </section>

    <footer>
        <div>
            <p>&copy; 2024 Project WEB</p>
        </div>  
    </footer>
</body>
</html>

<?php
// Tutup koneksi database
mysqli_close($conn);
?>
