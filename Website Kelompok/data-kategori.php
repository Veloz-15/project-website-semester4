<?php
    session_start();
    include 'db.php';
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }
    
    // Ambil data admin yang sedang login
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
                <h3>Kategori</h3>
                <div class="box">
                    <p><a href="tambah-kategori.php">Tambah Data</a></p>
                    <table border ="1" cellspacing ="0" class="table">
                        <thead>
                            <th width="60px">No</th>
                            <th>Kategori</th>
                            <th width="120px">Edit</th>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                // Modifikasi kueri SQL untuk hanya menampilkan data kategori yang dimiliki oleh admin yang sedang login
                                $kategori = mysqli_query($conn, "SELECT * FROM category WHERE seller_id = '$admin_id' ORDER BY category_id DESC");
                                while($row = mysqli_fetch_array($kategori)){
                            ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $row['category_name'] ?></td>
                                <td>
                                    <a href="edit-kategori.php?id=<?php echo $row['category_id'] ?>">Edit</a> ||
                                    <a href="hapus-kategori.php?idk=<?php echo $row['category_id'] ?>" onclick="return confirm('Hapus kategori?')">Hapus</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
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
