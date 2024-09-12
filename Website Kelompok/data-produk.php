<?php
    session_start();
    include 'db.php';
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Mobil Y.A.I</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
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
                <h3>Produk</h3>
                <div class="box">
                    <p style="width:102px; background-color: white; border: 2px solid #e0e0e0; border-radius: 10px; padding: 8px; margin: 5px 0 25px 0;"><a href="tambah-produk.php">Tambah Data</a></p>
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
                            <th width="120px">Edit</th>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                // Mengambil produk yang ditambahkan oleh admin saat ini
                                $produk = mysqli_query($conn, "SELECT * FROM car 
                                                               LEFT JOIN category ON car.car_category = category.category_id 
                                                               WHERE car.seller_id = '".$_SESSION['s_global']->seller_id."' 
                                                               ORDER BY car.car_id DESC");
                                if(mysqli_num_rows($produk) > 0 ){
                                    while($row = mysqli_fetch_array($produk)){
                            ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $row['car_brand'] ?></td>
                                <td><?php echo $row['car_model'] ?></td>
                                <td><?php echo $row['category_name'] ?></td>
                                <td><?php echo ($row['car_transmission'] == 1) ? 'Manual' : 'Matic' ?></td>
                                <td><?php echo $row['car_year'] ?></td>
                                <td>Rp<?php echo number_format($row['harga'])?></td>
                                <td><a href="produk/<?php echo $row['car_image'] ?>" target="blank"><img src="produk/<?php echo $row['car_image'] ?>" width="80px"></a></td>
                                <td><?php echo ($row['car_number'] == 1) ? 'Ganjil' : 'Genap' ?></td>
                                <td><?php echo $row['keterangan'] ?></td>
                                <td>
                                    <a href="edit-produk.php?id=<?php echo $row['car_id'] ?>">Edit</a> || 
                                    <a href="hapus-produk.php?idp=<?php echo $row['car_id'] ?>" onclick="return confirm('Hapus barang?')">Hapus</a>
                                </td>
                            </tr>
                            <?php 
                                    }
                                } else {
                            ?>
                            <tr>
                                <td colspan="13">Tidak ada data</td>
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