<?php
error_reporting(0);
include 'db.php';
$$kontak = mysqli_query($conn, "SELECT seller_phone, seller_email, seller_address FROM seller ORDER BY seller_id");
$a = mysqli_fetch_object($kontak);

$produk = mysqli_query($conn, "SELECT * FROM car WHERE car_id = '".$_GET['id']."' ");
$p = mysqli_fetch_object($produk);
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
                        <input type="text" name="search" placeholder="Cari Produk" value="<?php echo $_GET['search'] ?>">
                        <input type="hiden" name="kat" value="<?php echo $$_GET['kat'] ?>" >
                        <input type="submit" name="cari" value="cari Produk">
                    </form>
                </div>
            </div>
            
            <!--product detail-->
            <div class="section">
                <div class="container">
                    <h3>Detail produk</h3>
                    <div class="box">
                        <div class="col-2">
                            <img src="produk/<?php echo $p->car_image?>" width="100%">  
                        </div>
                        <div class="col-2">
                            <h3><?php echo $p->car_model?></h3> 
                            <h4>Rp. <?php echo number_format($p->harga) ?></h4>
                            <p>Deskripsi :<br>
                            <?php echo $p->keterangan ?>
                            </p>
                            <p><a href="https://api.whatsapp.com/send?phone=<?php echo $a->admin_telp ?>&text=Hai, saya tertarik dengan produk anda." target="_blank">Hubungi via whattapp<img src="/img/wa.jpeg" width="50px"></a></p>
                        </div>
                    </div>
                </div>
            </div>
         
            

            <!-- footer -->
            <div class="footer">
                <div class="container">
                    <h4>Alamat</h4>
                    <p><?php echo $a->admin_address ?></p>                 
                    <h4>Email</h4>
                    <p><?php echo $a->admin_email ?></p>                 
                    <h4>No . Hp</h4>
                    <p><?php echo $a->admin_telp ?></p>                 
                    <small>Copyright $  ; 2024 - jualmobil.</small>
                </div>
            </div>
        </header>
    </body>
</html>  