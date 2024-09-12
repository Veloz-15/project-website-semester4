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
                    <input type="text" name="search" placeholder="Cari Produk" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                    <input type="submit" name="cari" value="cari Produk">
                </form>

                </div>
            </div>

            <!-- new product -->
            <div class="section">
                 <div class="container">
                    <div class="box">
                        <?php
                        $where = "";
                        if(isset($_GET['search']) && $_GET['search'] != '' ) {
                            $keyword = $_GET['search'];
                            $where .= "AND (car_model LIKE '%$keyword%' OR car_brand LIKE '%$keyword%') ";
                        }
                        
                        $produk = mysqli_query($conn, "SELECT * FROM car WHERE 1 $where ORDER BY car_id DESC ");
                        if ($produk === false) {
                            echo "Error: " . mysqli_error($conn);
                        } else {
                            if (mysqli_num_rows($produk) > 0){
                                while($p = mysqli_fetch_array($produk)){
                        ?>
                        <a href="detail-produk.php?id=<?php echo $p['car_id'] ?>" >
                            <div class="col-4">
                                <img src="produk/<?php echo $p['car_image'] ?>">
                                <p class="nama"><?php echo $p['car_brand'] ?> <?php echo $p['car_model'] ?></p> 
                                <p class="nama"><?php echo $p['car_year'] ?></p> 
                                <p class="harga">Rp. <?php echo number_format($p['harga']) ?></p>
                            </div>
                        </a>
                        <?php }}} ?>
                        <?php if (mysqli_num_rows($produk) == 0): ?>
                            <p>Produk tidak ada</p>
                        <?php endif; ?>
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
