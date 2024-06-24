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

// Handle approval or rejection of recipes
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['approve_recipe'])) {
        $recipe_id = $_POST['recipe_id'];
        $sql_approve = "UPDATE unggah_resep SET is_approved=1 WHERE id='$recipe_id'";
        if ($conn->query($sql_approve) === TRUE) {
            echo "Resep disetujui.";
        } else {
            echo "Error: " . $conn->error;
        }
    } elseif (isset($_POST['reject_recipe'])) {
        $recipe_id = $_POST['recipe_id'];
        $sql_reject = "DELETE FROM unggah_resep WHERE id='$recipe_id'";
        if ($conn->query($sql_reject) === TRUE) {
            echo "Resep ditolak dan dihapus.";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

// Query to fetch unggah_resep pending approval
$sql = "SELECT * FROM unggah_resep WHERE is_approved=0";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="resep_saya.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <title>Manage Recipes - Admin</title>
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
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="manage-recipes-container">
        <h2>Unggahan Resep Menunggu Persetujuan</h2>
        
        <?php
        if ($result->num_rows > 0) {
            echo '<table>';
            echo '<tr><th>ID</th><th>nama_resep</th><th>Penulis</th><th>Aksi</th></tr>';
            while($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['nama_resep'] . '</td>';
                echo '<td>
                        <form method="POST" action="kelolah_resep.php">
                            <input type="hidden" name="recipe_id" value="' . $row['id'] . '">
                            <button type="submit" name="approve_recipe">Setujui</button>
                            <button type="submit" name="reject_recipe">Tolak</button>
                        </form>
                      </td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '<p>Tidak ada unggahan resep yang menunggu persetujuan.</p>';
        }
        ?>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    </div>
</body>
</html>
