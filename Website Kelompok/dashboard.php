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
                <h3>Dashboard</h3>
                <div class="box">
                    <h4>Selamat Datang: <?php echo $_SESSION['s_global']->seller_name ?></h4> <br>
                    <table border="1" cellspacing="0" class="table">
                        <thead>
                            <th width="60px">No</th>
                            <th>Brand</th>
                            <th>Model</th>
                            <th>Kategori</th>
                            <th>Transmisi</th>
                            <th>Tahun</th>
                            <th>Harga</th>
                            <th>Gambar</th>
                            <th>Nomor Kendaraan</th>
                            <th>Keterangan</th>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                // Modifikasi kueri SQL untuk hanya menampilkan data yang dimiliki oleh admin yang sedang login
                                $produk = mysqli_query($conn, "SELECT * FROM car LEFT JOIN category ON car.car_category = category.category_id WHERE car.seller_id = '$admin_id' ORDER BY car.car_id DESC");
                                if ($produk === false) {
                                    die(mysqli_error($conn)); // Menampilkan pesan kesalahan jika query gagal dieksekusi
                                }
                                if(mysqli_num_rows($produk) > 0 ){
                                    while($row = mysqli_fetch_array($produk)){
                            ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $row['car_brand'] ?></td>
                                <td><?php echo $row['car_model'] ?></td>
                                <td><?php echo $row['category_name'] ?></td>
                                <td><?php echo ($row['car_transmission'] == 1)?'Manual':"Matic" ?></td>
                                <td><?php echo $row['car_year'] ?></td>
                                <td>Rp<?php echo number_format($row['harga'])?></td>
                                <td><a href="produk/<?php echo $row['car_image'] ?>" target="_blank"><img src="produk/<?php echo $row['car_image'] ?>" width="80px"></a></td>
                                <td><?php echo ($row['car_number'] == 1)?'Ganjil':'Genap'?></td>
                                <td><?php echo $row['keterangan'] ?></td> 
                            </tr>
                            <?php }}else{?>
                                <tr>
                                    <td colspan="10">tidak ada data</td>
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
