<?php
session_start();
include('includes/config.php');
error_reporting(0);

// Handle deletion of ratings
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);

    // Delete rating record from the database
    $query = "DELETE FROM curriculum_ratings WHERE id = $id";
    if (mysqli_query($con, $query)) {
        echo "<script>alert('Rating deleted successfully');</script>";
        echo "<script>window.location.href = 'all-ratings.php';</script>";
    } else {
        echo "<script>alert('Error deleting rating');</script>";
    }
}

// Fetch all curriculum ratings
$query = "SELECT * FROM curriculum_ratings ORDER BY id ASC";
$result = mysqli_query($con, $query);

if (!$result) {
    die("Error fetching ratings: " . mysqli_error($con));
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
                        <h4 class="page-title">Curriculum Ratings</h4>
                        <ol class="breadcrumb p-0 m-0">
                            <li><a href="#">Admin</a></li>
                            <li><a href="#">Curriculum</a></li>
                            <li class="active">All Ratings</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="demo-box m-t-20">
                        <div class="m-b-30">
                            <a href="add-rating.php">
                                <button class="btn btn-custom waves-effect waves-light btn-md">Add New Rating</button>
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table class="table m-0 table-bordered" id="example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Parameter</th>
                                        <th>Numerical Rating</th>
                                        <th>Descriptive Rating</th>
                                        <th>Date Rated</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $cnt = 1;

                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                            <tr>
                                                <td><?php echo $cnt++; ?></td>
                                                <td><?php echo htmlspecialchars($row['parameter']); ?></td>
                                                <td><?php echo htmlspecialchars($row['numerical_rating']); ?></td>
                                                <td><?php echo htmlspecialchars($row['descriptive_rating']); ?></td>
                                                <td><?php echo htmlspecialchars($row['date_rated']); ?></td>
                                                <td>
                                                    <a href="edit-rating.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                                    <a href="all-ratings.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this rating?');">Delete</a>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='6'>No ratings found.</td></tr>";
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
