<?php 
session_start();
include('includes/config.php');
error_reporting(0);

if(strlen($_SESSION['login']) == 0) { 
    header('location:index.php');
} else {

    $postid = intval($_GET['pid']); // Get Post ID from URL

    // Fetch existing post data
    $query = mysqli_query($con, "SELECT * FROM tblposts WHERE id = '$postid'");
    $post = mysqli_fetch_array($query);

    if(!$post) {
        $_SESSION['error'] = "Post not found!";
        header("Location: manage-posts.php");
        exit();
    }

    // Handle post update
    if(isset($_POST['update'])) {
        $posttitle = mysqli_real_escape_string($con, $_POST['posttitle']);
        $postdetails = mysqli_real_escape_string($con, $_POST['postdescription']);

        // Handle image upload (if changed)
        if(!empty($_FILES["postimage"]["name"])) {
            $imgfile = $_FILES["postimage"]["name"];
            $extension = strtolower(pathinfo($imgfile, PATHINFO_EXTENSION));
            $allowed_extensions = array("jpg", "jpeg", "png", "gif");

            if(!in_array($extension, $allowed_extensions)) {
                $_SESSION['error'] = "Invalid format. Only JPG, JPEG, PNG, and GIF allowed!";
                header("Location: edit-post.php?pid=$postid");
                exit();
            } else {
                $imgnewfile = md5(time() . $imgfile) . "." . $extension;
                move_uploaded_file($_FILES["postimage"]["tmp_name"], "postimages/" . $imgnewfile);

                // Update post with new image
                $query = mysqli_query($con, "UPDATE tblposts SET PostTitle = '$posttitle', PostDetails = '$postdetails', PostImage = '$imgnewfile' WHERE id = '$postid'");
            }
        } else {
            // Update post without changing image
            $query = mysqli_query($con, "UPDATE tblposts SET PostTitle = '$posttitle', PostDetails = '$postdetails' WHERE id = '$postid'");
        }

        if($query) {
            $_SESSION['msg'] = "Post updated successfully!";
        } else {
            $_SESSION['error'] = "Something went wrong. Please try again.";
        }
        header("Location: edit-post.php?pid=$postid");
        exit();
    }
?>

<!-- Include Header & Sidebar -->
<?php include('includes/topheader.php'); ?>
<?php include('includes/leftsidebar.php'); ?>

<div class="content-page">
    <div class="content">
        <div class="container">

            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Edit Post</h4>
                        <ol class="breadcrumb p-0 m-0">
                            <li><a href="#">Admin</a></li>
                            <li><a href="manage-posts.php">Manage Posts</a></li>
                            <li class="active">Edit Post</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <!-- Success / Error Messages -->
            <?php if(isset($_SESSION['msg'])) { ?>
                <div class="alert alert-success">
                    <strong>Success!</strong> <?php echo $_SESSION['msg']; unset($_SESSION['msg']); ?>
                </div>
            <?php } ?>
            <?php if(isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger">
                    <strong>Error!</strong> <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php } ?>

            <!-- Edit Post Form -->
            <form method="post" enctype="multipart/form-data" class="row">
                <div class="form-group col-md-6">
                    <label>Post Title</label>
                    <input type="text" class="form-control" name="posttitle" value="<?php echo htmlentities($post['PostTitle']); ?>" required>
                </div>

                <div class="col-sm-12">
                    <div class="card-box">
                        <h4 class="header-title"><b>Post Details</b></h4>
                        <textarea class="summernote" name="postdescription" required><?php echo htmlentities($post['PostDetails']); ?></textarea>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="card-box">
                        <h4 class="header-title"><b>Current Feature Image</b></h4>
                        <img src="postimages/<?php echo htmlentities($post['PostImage']); ?>" class="img-fluid rounded" style="width: 200px; height: 120px; object-fit: cover;">
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="card-box">
                        <h4 class="header-title"><b>Upload New Image (Optional)</b></h4>
                        <input type="file" class="form-control" name="postimage">
                    </div>
                </div>

                <button type="submit" name="update" class="btn btn-custom btn-md">Update Post</button>
                <a href="manage-posts.php" class="btn btn-danger">Cancel</a>
            </form>

        </div>
    </div>
    <?php include('includes/footer.php'); ?>
</div>

<?php } ?>
