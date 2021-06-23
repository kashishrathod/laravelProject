<?php include('db.php');
$_SESSION['login'] = true;
session_start();

if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $result = mysqli_query($conn, "SELECT * FROM user where email='$email' and password='$password'");
    $count = mysqli_num_rows($result);
    if($count == 1) {
        $_SESSION['email'] = $email;
        header('Location:show_blog.php');
    }
    else {
        echo "error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <!--bootstrap-->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
</head>

<body>
    <section id="signup" style="margin-top: 190px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <form action="" method="post">
                        <h3 class="text-center">Login</h3>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter your Email">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Enter the password">
                        </div>
                        <button type="submit" name="login" class="btn btn-primary">Login</button>
                        <div class="">
                            Don't have an account?
                            <a href="register.php">Signup</a>
                        </div>
                    </form>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </section>

    <!--custom jquery-->
    <script src="js/jquery.min.js"></script>

    <!--bootstrap-->
    <script src="js/bootstrap/bootstrap.min.js"></script>
</body>

</html>