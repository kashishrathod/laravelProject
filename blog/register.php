<?php include("db.php"); ?>
<?php 

$name_validation = '/^[a-zA-Z]{1,50}$/';
$fname_validation = true;
$lname_validation = true;
$email_validation = true;
$pass_validation = true;
$mail_exist = false;
$message = "Email already exists!";

if(isset($_POST['signup'])) {
    $firstname = $_POST['f_name'];
    $lastname = $_POST['l_name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $pass = $_POST['password'];

    // validation
    $fname_check = preg_match($name_validation, $firstname);
    if (!$fname_check) {
        $fname_validation = false;
    }
    $lname_check = preg_match($name_validation, $lastname);
    if (!$lname_check) {
        $lname_validation = false;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_validation = false;
    }
    if (strlen($pass) < 8) {
        $pass_validation = false;
    }
    $check = mysqli_num_rows(mysqli_query($conn, "select * from user where email='$email'"));
    if($check > 0) {
        $mail_exist = true;
    }
    if($check == 0 && $fname_validation && $lname_validation && $email_validation && $pass_validation) {
        $query = "INSERT INTO user(firstname, lastname, email, password, isactive) VALUES('$firstname', '$lastname', '$email', '$password', 1)";
        $result = mysqli_query($conn, $query);
        header('Location: login.php');
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
<?php include "nav.php";

    ?>
    <section id="signup" style="margin-top: 190px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <form action="" method="post" onsubmit="return validate()">
                        <h3 class="text-center">Create an Account</h3>
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="f_name" class="form-control" id="fname" placeholder="Enter your first name">
                            <div class="text-danger">
                                <?php
                                if (!$fname_validation) {
                                    echo "Please enter your first name!";
                                }
                                ?>
                            </div>
                            <h6 id="fnamecheck" class="text-danger"></h6>
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="l_name" class="form-control" id="lname" placeholder="Enter your last name">
                            <div class="text-danger">
                                <?php
                                if (!$lname_validation) {
                                    echo "Please enter your last name!";
                                }
                                ?>
                            </div>
                            <h6 id="lnamecheck" class="text-danger"></h6>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" id="email" placeholder="Enter your Email">
                            <div class="text-danger">
                            <?php
                            if($mail_exist) {
                                echo $message;
                            }
                            else if (!$email_validation) {
                                echo "Please enter valid email!";
                            }
                            ?>
                            </div>
                            <h6 id="emailcheck" class="text-danger"></h6>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Enter the password">
                            <div class="text-danger">
                            <?php
                            if (!$pass_validation) {
                                echo "Password Length Should be more then 8 characters!";
                            }
                            ?>
                            </div>
                            <h6 id="passcheck" class="text-danger"></h6>
                        </div>
                        <button type="submit" name="signup" class="btn btn-primary">SIGNUP</button>
                        <div class="">
                            Already have an account?
                            <a href="login.php">Login</a>
                        </div>
                    </form>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </section>
    <script>
    // validation
    var valid = true;
        function validate() {
            // firstname
            let fnameValue = document.getElementById('fname').value;
            if (fnameValue.length == '') {
                document.getElementById('fnamecheck').innerHTML= 'Firstname is required!';
                valid = false;
            } else if (!fnameValue.trim('')) {
                document.getElementById('fnamecheck').innerHTML= 'Firstname does not allow white space!';
                valid = false;
            } else {
                document.getElementById('fnamecheck').innerHTML= '';
            }
            // lastname
            let lnameValue = document.getElementById('lname').value;
            if (lnameValue.length == '') {
                document.getElementById('lnamecheck').innerHTML= 'Latstname is required!';
                valid = false;
            } else if (!lnameValue.trim('')) {
                document.getElementById('lnamecheck').innerHTML= 'Laststname does not allow white space!';
                valid = false;
            } else {
                document.getElementById('lnamecheck').innerHTML= '';
            }
            // email 
            let emailformat = /\S+@\S+\.\S+/;
            let emailValue = document.getElementById('email').value;
            if(!emailValue.match(emailformat)) {
                console.log('test');
                document.getElementById('emailcheck').innerHTML= 'Email format is not valid!';
                valid = false;
            }
            else {
                document.getElementById('emailcheck').innerHTML= '';
            }
            // password
            let passValue = document.getElementById('password').value;
            if (passValue.length == '') {
                document.getElementById('passcheck').innerHTML= 'Password is required!';
                valid = false;
            } else if (passValue.length < 8) {
                document.getElementById('passcheck').innerHTML= 'Password length should be more than 8 character!';
                valid = false;
            } else {
                document.getElementById('passcheck').innerHTML= '';
            }
            return valid;
        }
    
    </script>

    <!--custom jquery-->
    <script src="js/jquery.min.js"></script>

    <!--bootstrap-->
    <script src="js/bootstrap/bootstrap.min.js"></script>
</body>

</html>