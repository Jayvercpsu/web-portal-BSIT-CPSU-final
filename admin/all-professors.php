<?php
session_start();
include('includes/config.php');
error_reporting(0);

if (isset($_GET['action']) && $_GET['action'] == 'del') {
    $pid = $_GET['rid'];
    $query = mysqli_query($con, "DELETE FROM professors WHERE id='$pid'");

    if ($query) {
        echo "<script>alert('Professor deleted successfully');</script>";
        echo "<script>window.location.href = 'all-professors.php';</script>";
    } else {
        echo "<script>alert('Error deleting professor');</script>";
    }
}
?>

<?php include('includes/topheader.php'); ?>
<?php include('includes/leftsidebar.php'); ?>

<!-- Start right Content here -->
<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">View All Professors</h4>
                        <ol class="breadcrumb p-0 m-0">
                            <li><a href="#">Admin</a></li>
                            <li><a href="#">Professors</a></li>
                            <li class="active">View All Professors</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="demo-box m-t-20">
                        <div class="m-b-30">
                            <a href="add-professors.php">
                                <button class="btn btn-custom waves-effect waves-light btn-md">Add Professor <i class="mdi mdi-plus-circle-outline"></i></button>
                            </a>
                        </div>
                        <div class="table-responsive">
                            <table class="table m-0 table-bordered" id="example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = mysqli_query($con, "SELECT * FROM professors");
                                    $cnt = 1;
                                    while ($row = mysqli_fetch_array($query)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $cnt; ?></td>
                                        <td><?php echo $row['full_name']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['created_at']; ?></td>
                                        <td>
                                            <a href="edit-professors.php?pid=<?php echo $row['id']; ?>">
                                                <button class="btn btn-primary">Edit</button>
                                            </a>
                                            <a href="all-professors.php?action=del&rid=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete?')">
                                                <button class="btn btn-danger">Delete</button>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                    $cnt++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
</div>
