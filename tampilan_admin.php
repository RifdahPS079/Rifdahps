<!-- Nurul Ulmi Mustafa= Membuat tampilan_admin.php-->
 
<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link rel="stylesheet" type="text/css" href="tampilan_admin.css">
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

    <div class="profile-container">
        <h2>Profil Admin</h2>
        <div class="profile-info">
            <label>Username:</label>
            <p><?php echo $_SESSION['username']; ?></p>
        </div>
        <div class="bottom-buttons">
            <button onclick="location.href='logout.php';">Logout</button>
        </div>
    </div>
</body>
</html>
