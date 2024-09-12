<?php
include 'db.php';
$kontak = mysqli_query($conn, "SELECT seller_phone, seller_email, seller_address FROM seller ORDER BY seller_id");
$a = mysqli_fetch_object($kontak);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Mobil Y.A.I</title>
        <link rel="stylesheet" type ="text/css" href="css/style.css">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    </head>
    <body>
        <!-- header-->
        <header>
            <div class="container">
            <img src="setir_merah.PNG">
                <h1><a href="index.php">MOBIL Y.A.I</a></h1>
                <ul>
                    <li><a href="produk.php">produk</a></li>
                </ul>
            </div>

            <!-- search -->
            <div class="search">
                <div class="container">
                    <form action="produk.php">
                        <input type="text" name="search" placeholder="Cari Produk">
                        <input type="submit" name="cari" value="cari Produk">
                    </form>
                </div>
            </div>

            <!--category -->
            <div class="section">
                <div class="container">
                    <h3>Kategori</h3>
                    <div class="box">
                        <?php
                        $kategori = mysqli_query($conn, "SELECT * FROM category ORDER BY category_id DESC ");
                        if(mysqli_num_rows($kategori) > 0) {
                            while($k = mysqli_fetch_array($kategori)){
                        ?>
                        <a href="produk.php?kat=<?php echo $k['category_id'] ?>">
                        <div class="col-5">
                            <img src="img/linesmenu.PNG"  style="margin-bottom: 5px;" >
                            <p><?php echo $k['category_name'] ?></p>   
                        </div>
                        </a>
                        <?php }} else {?>
                            <p>Kategori tidak ada</p>
                        <?php } ?>
                    </div>
                </div>
            </div>
           

            <!--new producr -->
            <div class="section">
                <div class="container">
                    <hi>Produk Terbaru</hi>
                    <div class="box">
                        <?php
                        $produk = mysqli_query($conn, "SELECT * FROM car ORDER BY car_id DESC ");
                        if (mysqli_num_rows($produk) > 0){
                            while($p = mysqli_fetch_array($produk)){
                        ?>
                        <a href="detail-product.php?id=<?php echo $p['car_id'] ?>" >
                        <div class="col-4">
                            <img src="produk/<?php echo $p['car_image'] ?>">
                            <p class="nama"><?php echo $p['car_brand'] ?> <?php echo $p['car_model'] ?></p> 
                            <p class="nama"><?php echo $p['car_year'] ?></p> 
                            <p class="harga">Rp. <?php echo number_format($p['harga']) ?></p>
                        </div>
                        </a>
                        <?php }}else{ ?>
                            <p>Produk tidak ada</p>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <!-- footer -->
            <div class="footer">
                <div class="container">
                    <h4>Alamat</h4>
                    <p><?php echo $a->seller_address ?></p>                 
                    <h4>Email</h4>
                    <p><?php echo $a->seller_email ?></p>                 
                    <h4>No. Hp</h4>
                    <p><?php echo $a->seller_phone ?></p>                 
                    <small>Copyright $  ; 2024 - jualmobil.</small>
                </div>
            </div>
        </header>
    </body>
</html> 