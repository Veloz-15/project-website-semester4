<?php
    session_start();
    include 'db.php';
    
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
            
        </header>

        <!--content-->
        <div class="section">
            <div class="container">
                <h3>Daftar</h3>
                <div class="box">
                <form action="" method="POST">
                        Nama <input type="text" name="nama" placeholder="Nama Lengkap" class="input-control"  required>
                        Username <input type="text" name="user" placeholder="Username" class="input-control"  required>
                        Nomor HP <input type="text" name="hp" placeholder="Nomor HP" class="input-control"  required>
                        Email <input type="email" name="email" placeholder="email" class="input-control"  required>
                        Alamat <input type="text" name="alamat" placeholder="Alamat" class="input-control"  required>
                        Masukan Password <input type="password" name="pass1" placeholder="Masukan Password" class="input-control"  required>
                        Konfirmasi Password <input type="password" name="pass2" placeholder="Konfirmasi Password" class="input-control"  required>
                        <input type="submit" name="submit" value="Simpan" class="tombol"> 
                    </form>
                    <?php
                        if(isset($_POST['submit'])){

                            $nama   = ucwords($_POST['nama']);
                            $user   = $_POST['user'];
                            $hp     = $_POST['hp'];
                            $email  = $_POST['email'];
                            $alamat = ucwords($_POST['alamat']);
                            $pass1   = $_POST['pass1'];
                            $pass2     = $_POST['pass2'];
                    
                            $update = mysqli_query($conn, "INSERT INTO seller (seller_name, username, seller_phone, seller_email, seller_address, password) VALUES ('".$nama."', '".$user."', '".$hp."', '".$email."', '".$alamat."', '".MD5($pass1)."')");

                    
                            if($pass2 != $pass1){
                                echo '<script>alert("Konfirmasi password tidak sesuai")</script>';
                            } else {
                                if($update){
                                    echo'<script>alert("Berhasil mendaftar")</script>';
                                    echo'<script>window.location="profil.php"</script>';
                                } else {
                                    echo 'Gagal' . mysqli_error($conn);
                                } 
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