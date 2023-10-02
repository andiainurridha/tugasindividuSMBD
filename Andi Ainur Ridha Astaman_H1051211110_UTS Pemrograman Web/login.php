<?php
    session_start();
    require "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Login</title>
    <style>
        .main{
            height: 100vh;
        }
        .login-box{
            width: 500px;
            height: 300px;
            box-sizing: border-box;
            border-radius: 10px
        }
    </style>
</head>
<body>
    <div class="main d-flex flex-column justify-content-center align-items-center">
        <!--Tampilan Login-->
        <div class="login-box p-5 shadow">
            <!--Form untuk login-->
            <form action="" method="post">
                <div>
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username" required>
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <div>
                    <button class="btn btn-success form-control mt-3" type="submit" name="submit">Login</button>
                </div>
            </form>
        </div>

        <div class="mt-3" style="width: 500px">
        <!--Aliran kontrol dan fungsi untuk menghubungkan ke database-->
            <?php
                if (isset($_POST['submit'])){
                    $username = $_POST['username'];
                    $password = md5($_POST['password']);

                    $query = mysqli_query($connect, "SELECT * FROM admin WHERE username='$username' and password='$password'");
                    $countdata = mysqli_num_rows($query);
                    $data = mysqli_fetch_array($query);

                    if ($countdata>0){
                        $_SESSION['username'] = $data['username'];
                        $_SESSION['login']=true;
                        header('location: index.php');
                    }
                    else {
                        echo "<div class=\"alert alert-warning\">Username atau Kata Sandi yang dimasukkan salah!</div>";
                    }
                }
            ?>
        </div>
    </div>
</body>
</html>