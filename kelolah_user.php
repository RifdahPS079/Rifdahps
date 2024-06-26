<!-- Nada Istiana Habibi = Membuat kelolah user -->
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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_user'])) {
    $user_id = $_POST['user_id'];
    $sql_delete = "DELETE FROM users WHERE id='$user_id'";
    if ($conn->query($sql_delete) === TRUE) {
        $message = "Pengguna berhasil dihapus.";
    } else {
        $message = "Error: " . $sql_delete . "<br>" . $conn->error;
    }
}

$sql = "SELECT id, nama_lengkap, username, email, foto_profil FROM users";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Website - Kelola Pengguna</title>
    <style>
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

        .user-management-container {
            width: 90%;
            margin: 30px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .user-management-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .user-management-container table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .user-management-container table, th, td {
            border: 1px solid #ddd;
        }

        .user-management-container th, td {
            padding: 12px;
            text-align: left;
        }

        .user-management-container th {
            background: #333;
            color: #fff;
        }

        .profile-picture {
            width: 50px;
            height: 50px;
            object-fit: cover;
        }

        .back-btn, .delete-btn {
            display: inline-block;
            padding: 10px 20px;
            background: #333;
            color: #fff;
            text-decoration: none;
            text-transform: uppercase;
            border: none;
            cursor: pointer;
        }

        .back-btn:hover, .delete-btn:hover {
            background: #555;
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

    <div class="user-management-container">
        <button class="back-btn" onclick="window.history.back()">Kembali</button>
        <h2>Kelola Pengguna</h2>

        <?php if (isset($message)) echo "<p>$message</p>"; ?>

        <table>
            <thead>
                <tr>
                    <th>Nama Lengkap</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Foto Profil</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['nama_lengkap'] . "</td>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td><img src='uploads/" . $row['foto_profil'] . "' alt='Foto Profil' class='profile-picture'></td>";
                        echo "<td>
                            <form method='POST' action='kelolah_user.php'>
                                <input type='hidden' name='user_id' value='" . $row['id'] . "'>
                                <button type='submit' name='delete_user' class='delete-btn'>Hapus</button>
                            </form>
                        </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Tidak ada pengguna.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>