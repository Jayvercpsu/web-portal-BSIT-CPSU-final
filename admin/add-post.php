                                                    <?php
                                                    require_once dirname(__DIR__) . '/cloudinary.php';

                                                    session_start();
                                                    include('includes/config.php');
                                                    error_reporting(0);

                                                    if (strlen($_SESSION['login']) == 0) {
                                                        header('location:index.php');
                                                    } else {
                                                        if (isset($_POST['submit'])) {
                                                            $posttitle = mysqli_real_escape_string($con, $_POST['posttitle']);
                                                            $postdetails = mysqli_real_escape_string($con, $_POST['postdescription']);
                                                            $postedby = $_SESSION['login'];
                                                            $status = 1;
                                                            $arr = explode(" ", $posttitle);
                                                            $url = implode("-", $arr);

                                                            $allowed_extensions = array("jpg", "jpeg", "png", "gif");
                                                            $uploadedImages = [];
                                                            $cloudinaryUrls = [];
                                                            $cloudinaryPublicIds = [];

                                                            foreach ($_FILES['postimage']['name'] as $key => $imgfile) {
                                                                $extension = strtolower(pathinfo($imgfile, PATHINFO_EXTENSION));

                                                                if (in_array($extension, $allowed_extensions)) {
                                                                    $imgnewfile = md5(time() . $imgfile . $key) . "." . $extension;

                                                                    if (filter_var($_ENV['ENABLE_CLOUDINARY'], FILTER_VALIDATE_BOOLEAN)) {
                                                                        $fileArray = [
                                                                            'name' => $_FILES['postimage']['name'][$key],
                                                                            'type' => $_FILES['postimage']['type'][$key],
                                                                            'tmp_name' => $_FILES['postimage']['tmp_name'][$key],
                                                                            'error' => $_FILES['postimage']['error'][$key],
                                                                            'size' => $_FILES['postimage']['size'][$key],
                                                                        ];

                                                                        
                                                                        $uploadResponse = uploadImage($fileArray, 'Posts');
                                                                        if (isset($uploadResponse['error'])) {
                                                                            echo "<script>alert('Cloudinary upload failed: {$uploadResponse['error']}');</script>";
                                                                            continue;
                                                                        }

                                                                        $uploadedImages[] = ''; // Leave blank for local
                                                                        $cloudinaryUrls[] = $uploadResponse['url'];
                                                                        $cloudinaryPublicIds[] = $uploadResponse['public_id'];
                                                                    } else {
                                                                        move_uploaded_file($_FILES['postimage']['tmp_name'][$key], "postimages/" . $imgnewfile);
                                                                        $uploadedImages[] = $imgnewfile;
                                                                        $cloudinaryUrls[] = '';
                                                                        $cloudinaryPublicIds[] = '';
                                                                    }
                                                                } else {
                                                                    echo "<script>alert('Invalid image format: $imgfile');</script>";
                                                                }
                                                            }

                                                            // Convert arrays to strings
                                                            $imageString = implode(",", $uploadedImages);
                                                            $cloudinaryUrlString = implode(",", $cloudinaryUrls);
                                                            $cloudinaryPublicIdString = implode(",", $cloudinaryPublicIds);
                                                            
                                                            // Insert once for the whole post
                                                            $query = mysqli_query($con, "INSERT INTO tblposts 
                                                                (PostTitle, PostDetails, PostUrl, Is_Active, PostImage, cloudinary_url, cloudinary_public_id, postedBy) 
                                                                VALUES 
                                                                ('$posttitle', '$postdetails', '$url', '$status', '$imageString', '$cloudinaryUrlString', '$cloudinaryPublicIdString', '$postedby')");

                                                            if ($query) {
                                                                $msg = "Post successfully added with multiple images.";
                                                            } else {
                                                                $error = "Something went wrong. Try again.";
                                                            }
                                                        }
                                                    ?>


                                                        <!-- Include Header & Sidebar -->
                                                        <?php include('includes/topheader.php'); ?>
                                                        <?php include('includes/leftsidebar.php'); ?>

                                                        <style>
                                                            .multiple-images img {
                                                                margin: 5px;
                                                                border-radius: 10px;
                                                            }
                                                        </style>
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
                                                                            <?php if (isset($msg)) { ?>
                                                                                <div class="alert alert-success">
                                                                                    <strong>Well done!</strong> <?php echo htmlentities($msg); ?>
                                                                                </div>
                                                                            <?php } ?>
                                                                            <?php if (isset($error)) { ?>
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
                                                                                    <h4 class="header-title"><b>Feature Images</b></h4>
                                                                                    <input type="file" class="form-control" name="postimage[]" multiple required>
                                                                                    <small>Hold Ctrl (Cmd on Mac) to select multiple images</small>
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
                                                        <script>
                                                            function previewImages() {
                                                                var preview = document.getElementById("image-preview");
                                                                preview.innerHTML = "";
                                                                var files = document.querySelector('input[type=file]').files;

                                                                for (var i = 0; i < files.length; i++) {
                                                                    var reader = new FileReader();

                                                                    reader.onload = function(e) {
                                                                        var img = document.createElement("img");
                                                                        img.src = e.target.result;
                                                                        img.classList.add("img-thumbnail", "m-2");
                                                                        img.style.maxWidth = "150px";
                                                                        preview.appendChild(img);
                                                                    };

                                                                    reader.readAsDataURL(files[i]);
                                                                }
                                                            }
                                                        </script>

                                                    <?php } ?>