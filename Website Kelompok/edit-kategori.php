<?php
session_start();
include 'db.php';
if ($_SESSION['status_login'] != true) {
    echo '<script>window.location="login.php"</script>';
}


// Memastikan kategori yang akan diedit sesuai dengan admin yang sedang login
$kategori = mysqli_query($conn, "SELECT * FROM category WHERE category_id = '".$_GET['id']."' AND seller_id = '".$_SESSION['s_global']->seller_id."'");
if (mysqli_num_rows($kategori) == 0) {
    echo '<script>alert("Anda tidak memiliki izin untuk mengakses halaman ini!");window.location="data-kategori.php";</script>';
}

$k = mysqli_fetch_object($kategori);
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
        <h3>Edit Kategori</h3>
        <div class="box">
            <form action="" method="POST">
                <input type="text" name="nama" placeholder="Nama Kategori" class="input-control"
                       value="<?php echo $k->category_name ?>" required>
                <input type="submit" name="submit" value="Simpan" class="tombol">
            </form>
            <?php
            if (isset($_POST['submit'])) {
                $nama = ucwords($_POST['nama']);
                $update = mysqli_query($conn, "UPDATE category SET
                                            category_name='" . $nama . "'
                                            WHERE category_id='" . $k->category_id . "' ");

                if ($update) {
                    echo '<script>alert("edit data berhasil")</script>';
                    echo '<script>window.location="data-kategori.php"</script>';
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
