<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <titlE>Mobil Y.A.I</titlE>
        <link rel="stylesheet" type ="text/css" href="css/style.css">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    </head>
    <body id="bg-login">
        <div class="box-login">
            <h2>Login</h2>
            <form action="" method="POST">
                <input type="text" name="user" placeholder="Username" class="input-control">
                <input type="password" name="pass" placeholder="Password" class="input-control">
                <input type="submit" name="submit" value="Login" class="tombol">
                <a href="daftar.php" class="tombol">Daftar</a>
            </form>
            <?php
                if(isset($_POST['submit'])){
                    session_start();
                    include 'db.php';
                    $user = $_POST['user'];
                    $pass = $_POST['pass'];

                    $cek = mysqli_query($conn, "SELECT * FROM seller WHERE username = '".$user."' AND password = '".MD5($pass)."'");
                    if (mysqli_num_rows($cek)>0){
                        $d = mysqli_fetch_object($cek);
                        $_SESSION['status_login'] = true;
                        $_SESSION['s_global'] = $d;
                        $_SESSION['id'] = $d->seller_id;
                        echo '<script>window.location="dashboard.php"</script>';
                    }
                    else{
                        echo 'username atau anda password salah';
                    }
                }
            ?>
        </div>
    </body>




</html>