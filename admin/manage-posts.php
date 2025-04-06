<?php
session_start();
include('../cloudinary.php');
include('includes/config.php');
error_reporting(0);

if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {

    // Handle post deletion
    if (isset($_GET['action']) && $_GET['action'] == 'del') {
        $postid = intval($_GET['pid']);
        $query = mysqli_query($con, "UPDATE tblposts SET Is_Active = 0 WHERE id = '$postid'");

        if ($query) {
            $_SESSION['msg'] = "Post deleted successfully!";
        } else {
            $_SESSION['error'] = "Something went wrong. Please try again.";
        }
        header("Location: manage-posts.php");
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
                            <h4 class="page-title">Manage Posts</h4>
                            <ol class="breadcrumb p-0 m-0">
                                <li><a href="#">Admin</a></li>
                                <li><a href="#">Posts</a></li>
                                <li class="active">Manage Posts</li>
                            </ol>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

                <!-- Success / Error Messages -->
                <?php if (isset($_SESSION['msg'])) { ?>
                    <div class="alert alert-success">
                        <strong>Success!</strong> <?php echo $_SESSION['msg'];
                                                    unset($_SESSION['msg']); ?>
                    </div>
                <?php } ?>
                <?php if (isset($_SESSION['error'])) { ?>
                    <div class="alert alert-danger">
                        <strong>Error!</strong> <?php echo $_SESSION['error'];
                                                unset($_SESSION['error']); ?>
                    </div>
                <?php } ?>

                <!-- Post Table -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped" id="example">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = mysqli_query($con, "SELECT id, PostTitle, PostDetails, PostImage, cloudinary_url 
                                                                 FROM tblposts 
                                                                 WHERE Is_Active = 1 
                                                                 ORDER BY id DESC");

                                        if (mysqli_num_rows($query) == 0) {
                                            echo '<tr><td colspan="4" class="text-center text-danger"><h4>No records found.</h4></td></tr>';
                                        } else {
                                            // Check if Cloudinary is enabled
                                            $isCloudinaryEnabled = isset($_ENV['ENABLE_CLOUDINARY']) ? 
                                                                filter_var($_ENV['ENABLE_CLOUDINARY'], FILTER_VALIDATE_BOOLEAN) : 
                                                                false;
                                                                
                                            while ($row = mysqli_fetch_array($query)) {
                                        ?>
                                                <tr>
                                                    <td>
                                                        <?php
                                                        if ($isCloudinaryEnabled && !empty($row['cloudinary_url'])) {
                                                            // Use Cloudinary URL if enabled and available
                                                            $cloudinaryImages = explode(",", $row['cloudinary_url']);
                                                            $firstImage = trim($cloudinaryImages[0]);
                                                            ?>
                                                            <img src="<?php echo htmlentities($firstImage); ?>"
                                                                class="img-fluid rounded" style="width: 80px; height: 50px; object-fit: cover;">
                                                        <?php
                                                        } else {
                                                            // Fall back to local images
                                                            $imageArray = explode(",", $row['PostImage']);
                                                            $firstImage = trim($imageArray[0]);
                                                            ?>
                                                            <img src="postimages/<?php echo htmlentities($firstImage); ?>"
                                                                class="img-fluid rounded" style="width: 80px; height: 50px; object-fit: cover;">
                                                        <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?php echo htmlentities($row['PostTitle']); ?></td>
                                                    <td><?php echo substr(htmlentities($row['PostDetails']), 0, 100) . '...'; ?></td>
                                                    <td>
                                                        <a class="btn btn-primary btn-sm" href="edit-post.php?pid=<?php echo htmlentities($row['id']); ?>">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                        &nbsp;
                                                        <a class="btn btn-danger btn-sm" href="manage-posts.php?pid=<?php echo htmlentities($row['id']); ?>&action=del"
                                                            onclick="return confirm('Do you really want to delete this post?');">
                                                            <i class="fa fa-trash-o"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                        <?php }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- container -->
        </div> <!-- content -->
        <?php include('includes/footer.php'); ?>
    </div>

<?php } ?>