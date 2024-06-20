<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="tentang.css">
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
            <h2>Temukan Resep Yang Kamu Suka</h2>
            <form action="kategori_resep.php" class="search-box">
                <input type="text" name="keyword" placeholder="Cari Resep">
                <button type="submit">Cari</button>
            </form>
        </div>
    </section>

    <section class="recipes">
        <h1>KUMPULAN RESEP MAKANAN</h1>
        <div class="recipe-section">
            <!-- Kumpulan resep makanan -->
            <div class="recipe-card">
                <img src="images/gam1.jpg" alt="Nasi Goreng">
                <h2>Nasi Goreng</h2>
                <p>Nasi goreng adalah makanan berupa nasi yang digoreng dan dicampur dalam minyak goreng, margarin, atau mentega.</p>
                <a href="detail_resep.html">Lihat Resep</a>
            </div>
            <div class="recipe-card">
                <img src="images/gam2.webp" alt="Rendang">
                <h2>Rendang</h2>
                <p>Rendang adalah masakan daging yang berasal dari Minangkabau Sumatra Barat Indonesia, yang diolah dengan rempah-rempah pilihan.</p>
                <a href="detail_resep2.html">Lihat Resep</a>
            </div>
            <div class="recipe-card">
                <img src="images/gam3.webp" alt="Bakso">
                <h2>Bakso</h2>
                <p>Bakso adalah produk pangan yang terbuat dari bahan utama daging yang dilumatkan, dicampur dengan bahan lain.</p>
                <a href="detail_resep3.html">Lihat Resep</a>
            </div>
            <div class="recipe-card">
                <img src="images/gam4.jpg" alt="Pempek">
                <h2>Pempek</h2>
                <p>Pempek adalah salah satu makanan tradisional asal Palembang provinsi Sumatera Selatan, yang dikuahi dengan air yang gurih.</p>
                <a href="#">Lihat Resep</a>
            </div>
            <div class="recipe-card">
                <img src="images/gam5.webp" alt="Orek Tempe">
                <h2>Orek Tempe</h2>
                <p>Orek tempe berasal dari tanah Jawa ini adalah olahan tempe yang dipotong-potong kecil dan dimasak dengan gula serta kecap.</p>
                <a href="#">Lihat Resep</a>
            </div>
            <div class="recipe-card">
                <img src="images/gam6.webp" alt="Tumis Udang">
                <h2>Tumis Udang</h2>
                <p>Tumis udang adalah olahan makanan rumahan yang terbuat dari udang dan rempah-rempah, disatukan menjadi masakan favorit.</p>
                <a href="#">Lihat Resep</a>
            </div>
            <div class="recipe-card">
                <img src="images/gam7.jpg" alt="Terong Balado">
                <h2>Terong Balado</h2>
                <p>Terong balado adalah hidangan Minangkabau yang berupa terong dimasak dengan bumbu cabai merah balado yang pedas.</p>
                <a href="#">Lihat Resep</a>
            </div>
            <div class="recipe-card">
                <img src="images/gam8.jpg" alt="Martabak Manis">
                <h2>Martabak Manis</h2>
                <p>Martabak manis merupakan jenis kue dadar berupa adonan tepung terigu berasa manis yang dipanggang, diberi topping, dan dilipat.</p>
                <a href="#">Lihat Resep</a>
            </div>
            <div class="recipe-card">
                <img src="images/gam9.webp" alt="Martabak Telur">
                <h2>Martabak Telur</h2>
                <p>Martabak telur merupakan makanan yang dalam pengolahannya dengan cara digoreng, perpaduan telur yang sangat lezat.</p>
                <a href="#">Lihat Resep</a>
            </div>
            <div class="recipe-card">
                <img src="images/gam10.jpg" alt="Mie Titi">
                <h2>Mie Titi</h2>
                <p>Mie Titi ini merupakan sajian mie yang sangat mirip dengan masakan Tionghoa “Ifumie”, namun versi mie yang mirip lidi.</p>
                <a href="#">Lihat Resep</a>
            </div>
        </div>
    </section>

    <section class="recipes">
        <h2>KUMPULAN RESEP MINUMAN</h2>
        <div class="recipe-section">
            <div class="recipe-card">
                <img src="images/minum1.jpg" alt="Es Teh">
                <h3>Es Teh</h3>
                <p>Es teh adalah minuman teh yang disajikan dengan es batu, sering ditambahkan gula atau madu untuk rasa manis untuk rasa yang pas .</p>
                <a href="#">
                    <button class="link-button">Lihat Resep</button>
                </a>

            </div>
            <div class="recipe-card">
                <img src="images/minum2.jpg" alt="Jus Alpukat">    
                <h3>Jus Alpukat</h3>
                <p>Jus alpukat dibuat dengan mencampur alpukat segar, susu kental manis, dan es batu untuk rasa yang lembut dan menyegarkan.</p>
                <a href="#">
                    <button class="link-button">Lihat Resep</button>
                </a>
            </div>
            <div class="recipe-card">
                <img src="images/minum3.jpg" alt="Cendol">
                <h3>Cendol</h3>
                <p>Cendol adalah minuman tradisional yang terbuat dari tepung beras, santan, gula merah, dan es batu untuk rasa yang  menyegarkan.</p>
                <a href="#">
                    <button class="link-button">Lihat Resep</button>
                </a>
            </div>
            <div class="recipe-card">
                <img src="images/minum4.jpg" alt="Es Buah">
                <h3>Es Buah</h3>
                <p>Es buah terdiri dari berbagai macam buah segar yang dicampur dengan sirup manis dan es batu yang lebih segar dinikmati.</p>
                <a href="#">
                    <button class="link-button">Lihat Resep</button>
                </a>
            </div>
            <div class="recipe-card">
                <img src="images/minum5.jpg" alt="Kopi Susu">
                <h3>Kopi Susu</h3>
                <p>Kopi susu adalah minuman kopi yang dicampur dengan susu untuk rasa yang kaya dan creamy,bisa dicampur es batu.</p>
                <a href="#">
                    <button class="link-button">Lihat Resep</button>
                </a>
            </div>
        </div>
    </section>

    <section class="hero">
        <div class="hero-section">
            <h2>Hasil Pencarian Resep</h2>
            <?php
                if(isset($_GET['keyword'])) {
                    $keyword = $_GET['keyword'];
                    echo "<p>Hasil pencarian untuk: $keyword</p>";
                    // Di sini kamu bisa menulis kode untuk menampilkan hasil pencarian berdasarkan $keyword
                } else {
                    echo "<p>Tugas WEB AKHIR .</p>";
                }
            ?>
        </div>
    </section>

    <section class="about">
        <div class="Tentang Website FoodRecipes">
            <h2>Tentang FoodRecipes</h2>
            <div class="about-content">
                <img src="uploads/gambarTentang.jpg" alt="Tentang Website FoodRecipes">
                <div class="about-text">
                    <p>"FoodRecipes" menyediakan platform komprehensif bagi para pecinta makanan untuk menemukan, dan melihat resep, sehingga memudahkan pengguna untuk menjelajahi dan menikmati pengalaman kuliner baru.</p>
                    <p>Dengan antarmuka yang ramah pengguna dan fitur yang lengkap, "FoodRecipes" bertujuan menjadi tujuan utama bagi siapa saja yang mencari inspirasi memasak dan ingin berbagi kreasi kuliner mereka dengan komunitas yang lebih luas.</p>
                    <p>Platform ini tidak hanya membantu pengguna menemukan resep baru tetapi juga memungkinkan mereka berkontribusi dengan mengunggah resep mereka sendiri, menciptakan ekosistem kuliner yang dinamis dan interaktif.</p>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div>
            <p>&copy; 2024 Project WEB</p>
        </div>  
    </footer>
</body>
</html>
