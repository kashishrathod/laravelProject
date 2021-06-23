<?php include('db.php');
session_start();
if(isset($_SESSION['email'])) {
if(isset($_GET['id'])) {
    $delete_id = $_GET['id'];
        $email = $_SESSION['email'];
        $query = "select id from user where email='$email'";
        $userid = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($userid)) {
            $user = $row['id'];
        }
    $query_user_id = mysqli_query($conn, "SELECT * FROM blogpost WHERE id=$delete_id");
        while($row_id = mysqli_fetch_assoc($query_user_id)) {
            $blog_user_id = $row_id['user_id'];
        }
        if($user != $blog_user_id) {
            header('Location: show_blog.php');
        }
        else {
        $delete_blog = mysqli_query($conn, "UPDATE blogpost SET isactive=0 WHERE id=$delete_id");
        $delete_tag = mysqli_query($conn, "UPDATE tag SET isactive=0 WHERE blog_id=$delete_id");
        header('Location: show_blog.php');
        }
        
}
}
