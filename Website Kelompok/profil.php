<?php
    session_start();
    include 'db.php';
    if($_SESSION['status_login']!=true){
        echo '<script>window.location="login.php"</script>';
    }
        
    // Ambil data admin yang sedang login
    $query = mysqli_query($conn, "SELECT * FROM seller WHERE seller_id = '".$_SESSION['s_global']->seller_id."'");
    $d = mysqli_fetch_object($query);
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
                <h3>Profil</h3>
                <div class="box">
                <form action="" method="POST">
                        Nama <input type="text" name="nama" placeholder="Nama Lengkap" class="input-control" value="<?php echo  $d->seller_name ?>" required>
                        Username <input type="text" name="user" placeholder="Username" class="input-control" value="<?php echo $d->username ?>" required>
                        Nomor HP <input type="text" name="hp" placeholder="Nomor HP" class="input-control" value="<?php echo $d->seller_phone ?>" required>
                        Email <input type="email" name="email" placeholder="email" class="input-control" value="<?php echo $d->seller_email ?>" required>
                        Alamat <input type="text" name="alamat" placeholder="Alamat" class="input-control" value="<?php echo $d->seller_address ?>" required>
                        <input type="submit" name="submit" value="Simpan" class="tombol"> 
                    </form>
                    <?php
                        if(isset($_POST['submit'])){

                            $nama   = ucwords($_POST['nama']) ;
                            $user   = $_POST['user'];
                            $hp     = $_POST['hp'];
                            $email  = $_POST['email'];
                            $alamat = ucwords($_POST['alamat']);

                            $update = mysqli_query($conn, "UPDATE seller SET
                                                    seller_name     = '".$nama."',
                                                    username        = '".$user."',
                                                    seller_phone    = '".$hp."',
                                                    seller_email    = '".$email."',
                                                    seller_address  = '".$alamat."'
                                                    WHERE seller_id = '".$d->seller_id."' ");
                            if($update){
                                echo'<script>alert("berhasil mengubah data")</script>';
                                echo'<script>window.location="profil.php"</script>';
                            } else{
                                echo 'gagal' .mysqli_error($conn);
                            }                        
                        }
                    ?>
                </div>


                <h3>Password</h3>
                <div class="box">
                    <form action="" method="POST">
                        <input type="password" name="pass1" placeholder="Masukan Password Baru" class="input-control"  required>
                        <input type="password" name="pass2" placeholder="Konfirmasi Password" class="input-control"  required>
                        <input type="submit" name="ubah_password" value="Ubah Password" class="tombol">
                    </form>
                    <?php
                        if(isset($_POST['ubah_password'])){
                            $pass1   = $_POST['pass1'];
                            $pass2     = $_POST['pass2'];

                            if($pass2 != $pass1){
                                echo '<script>alert("Konfirmasi password tidak sesuai")</script>';
                            }else{
                                $update_pass = mysqli_query($conn, "UPDATE seller SET
                                                    password     = '".MD5($pass1)."'
                                                    WHERE seller_id = '".$d->seller_id."' ");
                                if ($update_pass){
                                    echo'<script>alert("berhasil mengubah password")</script>';
                                    echo'<script>window.location="profil.php"</script>';
                                }else{
                                    echo 'gagal' .mysqli_error($conn);
                                }
                            }
                        }    
                    ?>
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