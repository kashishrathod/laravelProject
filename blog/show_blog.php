<?php include('db.php');
session_start();
$get_blog_data = mysqli_query($conn, "SELECT * FROM blogpost WHERE isactive=1");
if(!$get_blog_data) {
    die(mysqli_error($conn));
}
if(isset($_SESSION['email'])) {
$email = $_SESSION['email'];
$query = "select id from user where email='$email'";
$userid = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($userid)) {
    $user = $row['id'];
}
}
else {

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
    <div class="container" style="margin-top: 100px;">
        <div class="row">
        <?php if(isset($_SESSION['email'])) { ?>
        <a href="logout.php" class="btn btn-danger" style="margin-left: 1050px; margin-bottom: 5px;" onclick="return confirm('Are you Sure you want to logout?');">Logout</a>
        <?php } else { ?>
            <a href="login.php" class="btn btn-danger" style="margin-left: 1050px; margin-bottom: 5px;">Login</a>
            <?php } ?>
            <div class="col-md-12">
                <div class="card-header">All Blog
                <?php if(isset($_SESSION['email'])) { ?>
                    <a href="addblog.php" id="add" class="btn btn-info" style="margin-left: 850px;">Add Blog</a>
                <?php } else { ?>
                    <button id="add" class="btn btn-info" style="margin-left: 850px;" disabled>Add Blog</button>
                <?php } ?>
                </div>
                <div class="card">
                    <table>
                        <thead>
                            <tr>
                                <th scope="col">Blog Image</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Tag</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($get_blog_data)) {
                                $blog_id = $row['id'];
                                $user_id = $row['user_id'];
                                $blog_img = $row['blog_img'];
                                $title = $row['title'];
                                $description = $row['description'];
                                $get_tag_name = mysqli_query($conn, "SELECT tag_name FROM tag WHERE blog_id=$blog_id AND isactive=1");
                                // while($row_tag = mysqli_fetch_assoc($get_tag_name)) {
                                //     $tag_name[] = $row_tag['tag_name'];
                                //     $tag_implode_name = implode(',', $tag_name);
                                // }
                                
                            ?>
                                <tr>
                                <th scope="row"><?php echo "<img src='$blog_img' width='80px' height='50px'>"; ?></th>
                                    <td><?php echo $title ?></td>
                                    <td>
                                    <?php if(strlen($description) > 100) {
                                        echo substr($description, 0, 100) . '...';
                                    }
                                    else {
                                        echo $description;
                                    }
                                    ?>
                                    </td>
                                    <td><?php 
                                        foreach($get_tag_name as $tag_name) {
                                            //print implode(", ", $tag_name); 
                                            echo $tag_name['tag_name'] . ', ';  
                                        }
                                    ?></td>
                                    <td>
                                        <?php if(isset($_SESSION['email']) && $user == $user_id) { ?>
                                        <a href="editblog.php?id=<?php echo $blog_id ?>" class="btn btn-info">Edit</a>
                                        <a href="deleteblog.php?id=<?php echo $blog_id ?>" class="btn btn-danger" onclick="return confirm('Are you Sure you want to delete?');">Delete</a>
                                        <?php } else { ?>
                                            <button class="btn btn-info" disabled>Edit</button>
                                            <button class="btn btn-danger" disabled>Delete</button>
                                        <?php } ?>    
                                    </td>
                                </tr>
                            <?php 
                         } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--custom jquery-->
    <script src="js/jquery.min.js"></script>

    <!--bootstrap-->
    <script src="js/bootstrap/bootstrap.min.js"></script>
</body>
</html>