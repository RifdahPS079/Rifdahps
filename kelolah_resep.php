<!-- Nurul Ulmi Mustafa= Membuat kelolah_resep.php-->
<?php
session_start();

$servername = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "proyek_web";

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $db_name);

// Check connection
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

// Check if there are rows returned
if ($result === false) {
    echo "Error fetching recipes: " . $conn->error;
} else {
    if ($result->num_rows > 0) {
        // ... generate table ...
    } else {
        echo '<p class="empty-message">Tidak ada unggahan resep yang menunggu persetujuan.</p>';
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Resep - Admin</title>
    <link rel="stylesheet" href="resep_saya.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Styling untuk header dan navigasi */
        *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }       

        
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        header {
            background-color: #1e1616;
            color: white;
            SSpadding: 10px 0;
        }

        header a {
            color: white;
            text-decoration: none;
            padding: 5px 20px;
            display: inline-block;
            transition: color 0.3s ease;
        }

        header ul {
            nav ul {
            padding: 0;
            list-style: none;
            display: flex;
            justify-content: space-between;
}
        }

        header .logo {
            float: left;
            margin-top: 10px;
        }

        header nav {
            float: right;
            margin-top: 0px;
        }

        header .nav-list, header .nav-log {
            float: right;
        }

        header .nav-list li, header .nav-log li {
            color: white;
            text-decoration: none;
            padding: 5px 20px;
            display: inline-block;
            transition: color 0.3s ease;
        }

        nav ul li a:hover {
            color: #e7782f;
        }

        .nav-list li a {
            color: white;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .nav-list li a:hover {
        color: #e7782f;
        }

        .manage-recipes-container {
            width: 90%;
            margin: 30px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .manage-recipes-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        table th {
            background-color: #f2f2f2;
        }
        table td {
            vertical-align: top;
        }
        form {
            display: inline-block;
        }
        button {
            padding: 5px 10px;
            margin-right: 5px;
            cursor: pointer;
        }
        p.empty-message {
            margin-top: 10px;
        }
    </style>
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
                    <li><a href="kelolah_user.php">Kelola User</a></li>           
                    <li><a href="profil_admin.php">Profil Admin</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="manage-recipes-container">
        <h2>Unggahan Resep Menunggu Persetujuan</h2>
        
        <?php
        if ($result->num_rows > 0) {
            echo '<table>';
            echo '<tr><th>ID</th><th>Nama Resep</th><th>Penulis</th><th>Aksi</th></tr>';
            while($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['nama_resep'] . '</td>';
                echo '<td>' . $row['username'] . '</td>';
                echo '<td>
                        <form method="POST" action="kelolah_resep.php">
                            <input type="hidden" name="recipe_id" value="' . $row['id'] . '">
                            <button type="submit" name="approve_recipe" class="btn btn-success">Setujui</button>
                            <button type="submit" name="reject_recipe" class="btn btn-danger">Tolak</button>
                        </form>
                      </td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '<p class="empty-message">Tidak ada unggahan resep yang menunggu persetujuan.</p>';
        }
        ?>

    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
