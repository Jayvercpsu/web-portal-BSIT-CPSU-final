<?php 
session_start();
include('includes/config.php');
error_reporting(0);

if(strlen($_SESSION['login']) == 0) { 
    header('location:index.php');
} else {

    // For adding post  
    if(isset($_POST['submit'])) {
        $posttitle = mysqli_real_escape_string($con, $_POST['posttitle']);
        $postdetails = mysqli_real_escape_string($con, $_POST['postdescription']);
        $postedby = $_SESSION['login'];

        // Generate URL-friendly post title
        $arr = explode(" ", $posttitle);
        $url = implode("-", $arr);

        // Image upload handling
        $imgfile = $_FILES["postimage"]["name"];
        $extension = strtolower(pathinfo($imgfile, PATHINFO_EXTENSION));

        // Allowed image formats
        $allowed_extensions = array("jpg", "jpeg", "png", "gif");

        if (!in_array($extension, $allowed_extensions)) {
            echo "<script>alert('Invalid format. Only jpg, jpeg, png, and gif are allowed');</script>";
        } else {
            // Rename and move the image file
            $imgnewfile = md5(time() . $imgfile) . "." . $extension;
            move_uploaded_file($_FILES["postimage"]["tmp_name"], "postimages/" . $imgnewfile);

            // Insert post data into the database (without category)
            $status = 1;
            $query = mysqli_query($con, "INSERT INTO tblposts (PostTitle, PostDetails, PostUrl, Is_Active, PostImage, postedBy) 
                                         VALUES ('$posttitle', '$postdetails', '$url', '$status', '$imgnewfile', '$postedby')");

            if($query) {
                $msg = "Post successfully added";
            } else {
                $error = "Something went wrong. Please try again.";    
            }
        }
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
                        <h4 class="page-title">Add Post</h4>
                        <ol class="breadcrumb p-0 m-0">
                            <li><a href="#">Post</a></li>
                            <li><a href="#">Add Post</a></li>
                            <li class="active">Add Post</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <!-- Success / Error Messages -->
            <div class="row">
                <div class="col-sm-6">
                    <?php if(isset($msg)) { ?>
                        <div class="alert alert-success">
                            <strong>Well done!</strong> <?php echo htmlentities($msg); ?>
                        </div>
                    <?php } ?>
                    <?php if(isset($error)) { ?>
                        <div class="alert alert-danger">
                            <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <!-- Post Form -->
            <form name="addpost" method="post" class="row" enctype="multipart/form-data">
                <div class="form-group col-md-6">
                    <label>Post Title</label>
                    <input type="text" class="form-control" name="posttitle" placeholder="Enter title" required>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <h4 class="header-title"><b>Post Details</b></h4>
                            <textarea class="summernote" name="postdescription" required></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <h4 class="header-title"><b>Feature Image</b></h4>
                            <input type="file" class="form-control" name="postimage" required>
                        </div>
                    </div>
                </div>

                <button type="submit" name="submit" class="btn btn-custom btn-md">Save and Post</button>
                <button type="reset" class="btn btn-danger">Discard</button>
            </form>

        </div>
    </div>
    <?php include('includes/footer.php'); ?>
</div>

<?php } ?>
