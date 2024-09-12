<?php
session_start();
include 'db.php';
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
}

// Mengambil produk yang akan diedit
$produk = mysqli_query($conn, "SELECT * FROM car WHERE car_id = '".$_GET['id']."'");
$p = mysqli_fetch_object($produk);


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
                <h3>Edit Produk</h3>
                <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">
                        
                        Brand<input type="text" name="brand" class="input-control" placeholder="contoh: toyota, suzuki, honda,dll" value="<?php echo $p->car_brand ?>" required>
                        Model<input type="text" name="model" class="input-control" placeholder="contoh: veloz, baleno, civic, dll" value="<?php echo $p->car_model ?>" required>
                        Kategori<select name="kategori" class="input-control" required>
                            <option value="">--Pilih--</option>
                            <?php
                                $kategori = mysqli_query($conn, "SELECT * FROM category ORDER BY category_id DESC");
                                while($r = mysqli_fetch_array($kategori)){
                            ?>
                            <option value="<?php echo $r['category_id'] ?>" <?php echo ($r['category_id'] == $p->car_category) ? 'selected' : ''; ?>><?php echo $r['category_name'] ?></option>
                            <?php } ?>
                        </select>
                        Transmisi <select name="transmisi" class="input-control" required>
                            <option value="1" <?php echo ($p->car_transmission == 1) ? 'selected' : ''; ?>>Manual</option>
                            <option value="0" <?php echo ($p->car_transmission == 0) ? 'selected' : ''; ?>>Matic</option>
                        </select>
                        Tahun<input type="number" name="tahun" class="input-control" min="1950" max="<?php echo date('Y'); ?>" value="<?php echo $p->car_year ?>" required>
                        Harga<input type="text" name="harga" class="input-control" placeholder="harga" value="<?php echo $p->harga ?>" required>
                        
                        <img src="produk/<?php echo $p->car_image ?>" width="100px">
                        <input type="hidden" name="foto_lama" value="<?php echo $p->car_image ?>">
                        Gambar<input type="file" name="gambar" class="input-control">
                        Nomor Kendaraan <select name="nomor_kendaraan" class="input-control">
                            <option value="">--Pilih--</option>
                            <option value="1" <?php echo ($p->car_number == 1) ? 'selected' : ''; ?>>Ganjil</option>
                            <option value="0" <?php echo ($p->car_number == 0) ? 'selected' : ''; ?>>Genap</option>
                        </select>
                        Keterangan<textarea name="deskripsi" class="input-control" placeholder="Deskripsi" ><?php echo $p->keterangan ?></textarea>
                        <input type="submit" name="submit" value="Simpan" class="tombol"> 
                    </form>
                    <?php
                    if (isset ($_POST['submit'])){
                        
                        // Data inputan dari form
                        $brand          = $_POST['brand'];
                        $model          = $_POST['model'];
                        $kategori       = $_POST['kategori'];
                        $transmisi      = $_POST['transmisi'];
                        $tahun          = $_POST['tahun'];
                        $harga          = $_POST['harga'];
                        $nomor_kendaraan= $_POST['nomor_kendaraan'];
                        $keterangan     = $_POST['deskripsi'];
                        $foto_lama      = $_POST['foto_lama'];

                        // Data gambar yang baru
                        $filename = $_FILES['gambar']['name'];
                        $tmp_name = $_FILES['gambar']['tmp_name'];
                        

                        // Jika seller ganti gambar
                        if ($filename !== '') {

                            $type1 = explode('.', $filename);
                            $type2 = $type1[1];
                            $newname = 'mobil' . time() . '.' . $type2;

                            // Menampung data format file yang diizinkan 
                            $tipe_diizinkan = array('jpg', 'jpeg', 'png');
                            // Validasi format file
                            if (!in_array($type2, $tipe_diizinkan)) {

                                // Jika format file tidak sesuai
                                echo 'Format file tidak didukung';
                            } else {
                                unlink('./produk/' . $foto_lama);
                                move_uploaded_file($tmp_name, './produk/' . $newname);
                                $namagambar = $newname;
                            }
                        } else {
                            // Jika seller tidak ganti gambar
                            $namagambar = $foto_lama;
                        }

                        // Query update data produk
                        $update = mysqli_query($conn, "UPDATE car SET
                                                car_brand = '".$brand."',
                                                car_model = '".$model."',
                                                car_category = '".$kategori."',
                                                car_transmission = '".$transmisi."',
                                                car_year = '".$tahun."',
                                                harga = '".$harga."',
                                                car_image = '".$namagambar."',
                                                car_number = '".$nomor_kendaraan."',
                                                keterangan = '".$keterangan."'
                                                WHERE car_id = '".$p->car_id."' ");
                        if ($update) {
                            echo '<script>alert("berhasil mengubah data")</script>';
                            echo '<script>window.location="data-produk.php"</script>';
                        } else {
                            echo 'gagal' . mysqli_error($conn);
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
