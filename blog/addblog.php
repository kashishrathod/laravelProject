<?php include('db.php');
session_start();

$title = "";
$blog_img = "";
$description = "";
$files = "";
$title_validation = true;
$desc_validation = true;
$img_validation = true;
$tag_validation = true;

if (isset($_SESSION['email'])) {
    if (isset($_POST['createblog'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $tag = $_POST['tag'];

        $email = $_SESSION['email'];
        $query = "select id from user where email='$email'";
        $userid = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($userid)) {
            $user = $row['id'];
        }
        if ($title == '') {
            $title_validation = false;
        }
        if ($description == '') {
            $desc_validation = false;
        }
        if ($tag == '') {
            $tag_validation = false;
        }
        if (isset($_FILES['blog_img']['name'])) {
            if (!empty($_FILES['blog_img']['name'])) {
                if (!empty($_FILES['blog_img']['type']) && $_FILES['blog_img']['type'] != 'image/jpeg' && $_FILES['blog_img']['type'] != 'image/jpg' && $_FILES['blog_img']['type'] != 'image/png') {
                    $img_validation = false;
                }
            }
        }
        // blog
        if ($title_validation && $desc_validation && $img_validation && $tag_validation) {
            $create_blog_result = mysqli_query($conn, "INSERT INTO blogpost(user_id, tag_id, title, description,
            blog_img, created_at, modified_at, isactive) VALUES($user, 'abc', '$title', '$description', 'abc', NOW(), NOW(), 1)");
            if (!$create_blog_result) {
                die(mysqli_error($conn));
            }


            $files = $_FILES['blog_img'];
            $filename = $files['name'];
            $filetmp = $files['tmp_name'];
            $extention = explode('.', $filename);
            $filecheck = strtolower(end($extention));

            $fileextstored = array('jpg', 'png', 'jpeg');

            $blog_id = mysqli_insert_id($conn);

            if (in_array($filecheck, $fileextstored)) {
                if (!is_dir('../Member/')) {
                    mkdir('../Member/');
                }

                if (!is_dir('../Member/' . $user)) {
                    mkdir('../Member/' . $user);
                }

                $destinationfile = '../Member/' . $user . '/' . "blog-pic-" . time() . '.' . $filecheck;
                move_uploaded_file($filetmp, $destinationfile);
                $query_pic = "update blogpost set blog_img='$destinationfile' where id=$blog_id";
                $result = mysqli_query($conn, $query_pic);
            }
            // tag
            $counttag = count($_POST['tag']);
            for ($i = 0; $i < $counttag; $i++) {
                $tag = $_POST['tag'][$i];
                echo $tag;
                $tag_result = mysqli_query($conn, "INSERT INTO tag(blog_id, tag_name, created_at, updated_at, isactive) VALUES($blog_id, '$tag', NOW(), NOW(), 1)");
            }
            $tag_data = mysqli_query($conn, "SELECT * FROM tag WHERE blog_id=$blog_id");
            while ($row = mysqli_fetch_assoc($tag_data)) {
                $tag_id[] = $row['id'];
            }
            $tag_value = implode(',', $tag_id);
            $update_tag_id = mysqli_query($conn, "UPDATE blogpost SET tag_id='$tag_value' WHERE id=$blog_id");
            header('Location: show_blog.php');
        }
    }
} else {
    header('Location:login.php');
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
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card-header">Create New Blog</div>
                <div class="card">
                    <div class="card-body">
                        <form action="" method="POST" onsubmit="return validate()" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="title">Blog Title</label>
                                <input type="text" name="title" class="form-control" id="title" aria-describedby="emailHelp">
                                <div class="text-danger">
                                    <?php
                                    if (!$title_validation) {
                                        echo "Title is required!";
                                    }
                                    ?>
                                </div>
                                <h6 id="titlecheck" class="text-danger"></h6>
                            </div>
                            <div class="form-group">
                                <label for="blog_img">Blog Image</label>
                                <input type="file" name="blog_img" class="form-control" id="file" aria-describedby="emailHelp">
                                <div class="text-danger">
                                    <?php
                                    if (!$img_validation) {
                                        echo "Field only supports jpg,jpeg,png!";
                                    }
                                    ?>
                                </div>
                                <h6 id="imgcheck" class="text-danger"></h6>
                            </div>
                            <div class="form-group new">
                                <label for="tag[]">Tag</label><br>
                                <a href="Javascript:void(0)" class="btn btn-info addtag">+</a><br>
                                <input type="text" name="tag[]" id="tag" class="form-control" aria-describedby="emailHelp" multiple>
                                <div class="text-danger">
                                    <?php
                                    if (!$tag_validation) {
                                        echo "Tag is required!";
                                    }
                                    ?>
                                </div>
                                <h6 id="tagcheck" class="text-danger"></h6>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" cols="100" rows="3"></textarea>
                                <div class="text-danger">
                                    <?php
                                    if (!$desc_validation) {
                                        echo "Description is required!";
                                    }
                                    ?>
                                </div>
                                <h6 id="desccheck" class="text-danger"></h6>
                            </div>
                            <button type="submit" name="createblog" class="btn btn-primary addblog">Add Blog</button>
                            <a href="" class="btn btn-secondary">cancle</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        // validation
        valid = true;

        function validate() {
            // title
            let titleValue = document.getElementById('title').value;
            if (titleValue.length == '') {
                document.getElementById('titlecheck').innerHTML = 'Title is required!';
                valid = false;
            } else if (!titleValue.trim('')) {
                document.getElementById('titlecheck').innerHTML = 'Title does not allow white space!';
                valid = false;
            } else {
                document.getElementById('titlecheck').innerHTML = '';
            }
            //description
            let descValue = document.getElementById('description').value;
            if (descValue.length == '') {
                document.getElementById('desccheck').innerHTML = 'Description is required!';
                valid = false;
            } else if (!descValue.trim('')) {
                document.getElementById('desccheck').innerHTML = 'Description does not allow white space!';
                valid = false;
            } else {
                document.getElementById('desccheck').innerHTML = '';
            }
            // tag
            let tagValue = document.getElementById('tag').value;
            if (tagValue.length == '') {
                document.getElementById('tagcheck').innerHTML = 'Tag is required!';
                valid = false;
            } else if (!tagValue.trim('')) {
                document.getElementById('tagcheck').innerHTML = 'Tag does not allow white space!';
                valid = false;
            } else {
                document.getElementById('tagcheck').innerHTML = '';
            }
            // image
            var imginput = document.getElementById('file');
            if (imginput.files.length === 0) {
                document.getElementById('imgcheck').innerHTML = 'Image is required!';
                valid = false;
            } else {
                document.getElementById('imgcheck').innerHTML = '';
            }
            return valid;
        }
    </script>
    <!--custom jquery-->
    <script src="js/jquery.min.js"></script>
    <script>
        $('#file').on('change', function() {
            const size =
                (this.files[0].size / 1024 / 1024).toFixed(2);
            if (size > 0.1) {
                $('#imgcheck').html('Image size is more than 100KB!');
            }
        });
        $(document).on('click', '.addtag', function() {
            var newtag = '<div id="group" style="display: flex; margin-top:7px"><input style="margin-right:2px;" type="text" id="delete" name="tag[]" class="form-control" aria-describedby="emailHelp"><a href="Javascript:void(0)" id="remove" class="btn btn-danger removetag">-</a></div>';
            $('.new').append(newtag);
        });
        $(document).on('click', '.removetag', function() {
            $(this).closest('#group').remove();
        });
    </script>

    <!--bootstrap-->
    <script src="js/bootstrap/bootstrap.min.js"></script>
</body>

</html>