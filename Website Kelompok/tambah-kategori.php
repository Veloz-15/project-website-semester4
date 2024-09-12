<?php
    session_start();
    include 'db.php';
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }
    
    // Ambil ID admin yang sedang login
    $admin_id = $_SESSION['s_global']->seller_id;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <titlE>Mobil Y.A.I</titlE>
        <link rel="stylesheet" type ="text/css" href="css/style.css">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    </head>
    <body>
        <!-- header-->
        <header>
            <div class="container">
                <img src="setir_merah.PNG">
                <h1><a href="dashboard.php">MOBIL Y.A.I</a></h1>
                <ul>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="profil.php">Profil</a></li>
                    <li><a href="data-kategori.php">Data Kategori</a></li>
                    <li><a href="data-produk.php">Data Produk</a></li>
                    <li><a href="keluar.php">Keluar</a></li>
                </ul>
            </div>
        </header>

        <!--content-->
        <div class="section">
            <div class="container">
                <h3>Tambah Kategori</h3>
                <div class="box">
                    <form action="" method="POST">
                        <input type="text" name="nama" placeholder="Nama Kategori" class="input-control"  required>
                        <input type="submit" name="submit" value="Simpan" class="tombol"> 
                    </form>
                    <?php
                    if (isset ($_POST['submit'])){
                        $nama = ucwords($_POST['nama']);
                        
                        // Masukkan data kategori beserta ID admin yang sedang login
                        $insert = mysqli_query($conn, "INSERT INTO category (category_name, seller_id) VALUES ('$nama', '$admin_id')");
                        if($insert){
                            echo '<script>alert("Tambah data berhasil")</script>';
                            echo '<script>window.location="data-kategori.php"</script>';
                        }else{
                            echo 'Gagal: ' . mysqli_error($conn);
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

        <!--copyright-->
        <footer>
            <div class="container">
                <small>Copyright &copy; 2024-jualmobil</small>
            </div>
        </footer>
    </body>
</html>
