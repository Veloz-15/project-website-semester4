<?php
session_start();
include 'db.php'; // Pastikan file db.php sudah berisi koneksi ke database

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
        <h3>Tambah Produk</h3>
        <div class="box">
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="text" name="brand" class="input-control" placeholder="Brand" required>
                <input type="text" name="model" class="input-control" placeholder="Model" required>
                <select name="kategori" class="input-control" required>
                    <option value="">--Pilih Kategori--</option>
                    <?php
                    $kategori = mysqli_query($conn, "SELECT * FROM category ORDER BY category_id DESC");
                    while($r = mysqli_fetch_array($kategori)){
                        ?>
                        <option value="<?php echo $r['category_id'] ?>"><?php echo $r['category_name'] ?></option>
                        <?php
                    }
                    ?>
                </select>
                <select name="transmisi" class="input-control">
                    <option value="Manual">Manual</option>
                    <option value="Matic">Matic</option>
                </select>
                <input type="number" name="tahun" class="input-control" placeholder="Tahun" min="1950" max="<?php echo date('Y'); ?>" required>
                <input type="text" name="harga" class="input-control" placeholder="Harga" required>
                <input type="file" name="gambar" class="input-control" required>
                <select name="nomor_kendaraan" class="input-control">
                    <option value="Ganjil">Ganjil</option>
                    <option value="Genap">Genap</option>
                </select>
                <textarea name="deskripsi" class="input-control" placeholder="Deskripsi"></textarea>
                <input type="submit" name="submit" value="Simpan" class="tombol"> 
            </form>
            <?php
            if (isset ($_POST['submit'])){
                // Menangkap inputan dari form
                $brand = $_POST['brand'];
                $model = $_POST['model'];
                $kategori = $_POST['kategori'];
                $transmisi = $_POST['transmisi'];
                $tahun = $_POST['tahun'];
                $harga = $_POST['harga'];
                $nomor_kendaraan = $_POST['nomor_kendaraan'];
                $deskripsi = $_POST['deskripsi'];

                // Menangkap data file yang diupload
                $filename = $_FILES['gambar']['name'];
                $tmp_name = $_FILES['gambar']['tmp_name'];
                $type1 = explode('.', $filename);
                $type2 = $type1[1];
                $newname = 'mobil'.time().'.'.$type2;

                // Mengecek format file yang diizinkan
                $allowed_types = array('jpg', 'jpeg', 'png');

                // Validasi format file
                if (!in_array($type2, $allowed_types)){
                    // Jika format file tidak sesuai
                    echo 'Format file tidak didukung';
                } else {
                    // Jika format file sudah sesuai
                    // Upload file dan insert ke database
                    move_uploaded_file($tmp_name, './produk/'.$newname);

                    $insert = mysqli_query($conn, "INSERT INTO car (car_brand, car_model, car_category, car_transmission, car_year, harga, car_image, car_number, keterangan, seller_id) VALUES (
                        '$brand',
                        '$model',
                        '$kategori',
                        '$transmisi',
                        '$tahun',
                        '$harga',
                        '$newname',
                        '$nomor_kendaraan',
                        '$deskripsi',
                        '$admin_id'
                    )");
                    if($insert){
                        echo '<script>alert("Berhasil menambah data")</script>';
                        echo '<script>window.location="data-produk.php"</script>';
                    } else {
                        echo 'Gagal: ' . mysqli_error($conn);
                    }
                }
            }
            ?>
        </div>
    </div>
</div>

<!--footer-->
<footer>
    <div class="container">
        <small>&copy; 2024 Mobil Y.A.I</small>
    </div>
</footer>
</body>
</html>
