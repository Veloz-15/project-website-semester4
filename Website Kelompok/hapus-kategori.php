<?php
    include 'db.php';
    if(isset($_GET['idk'])){
        $delete= mysqli_query($conn, "DELETE FROM category WHERE category_id = '".$_GET['idk']."' ");
        echo'<script>window.location="data-kategori.php"</script>';
    }

    if(isset($_GET['idp'])){
        $produk = mysqli_query($conn, "SELECT car_image FROM car WHERE car_id = '".$_GET['idp']."' ");
        $p = mysqli_fetch_object($produk);
        unlink('./produk/'.$p->car_image);
        $delete = mysqli_query($conn, "DELETE FROM car WHERE car_id = '".$_GET['idp']."' ");
        echo'<script>window.location="data-produk.php"</script>';
    }

?>