<div class="row justify-content-center" style="margin-top: 4%">
    <div class="col-md-2 mt-4">
    </div>
    <div class="col-md-7">
        <h4 class="widget-title mb-4">Today <span>Highlight</span></h4>
        <!-- Blog Post -->
        <div class="row">


            <?php
            if (isset($_GET['pageno'])) {
                $pageno = $_GET['pageno'];
            } else {
                $pageno = 1;
            }
            $no_of_records_per_page = 8;
            $offset = ($pageno - 1) * $no_of_records_per_page;


            $total_pages_sql = "SELECT COUNT(*) FROM tblposts";
            $result = mysqli_query($con, $total_pages_sql);
            $total_rows = mysqli_fetch_array($result)[0];
            $total_pages = ceil($total_rows / $no_of_records_per_page);


            $query = mysqli_query($con, "select tblposts.id as pid,tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.Is_Active=1 order by tblposts.id desc  LIMIT $offset, $no_of_records_per_page");
            while ($row = mysqli_fetch_array($query)) {
            ?>
                <div class="col-md-6">
                    <div class="card mb-4 border-0">
                        <img class="card-img-top" src="admin/postimages/<?php echo htmlentities($row['PostImage']); ?>" alt="<?php echo htmlentities($row['posttitle']); ?>" height="200px">
                        <div class="card-body">
                            <p class="m-0">
                                <!--category-->
                                <a class="badge bg-dark text-decoration-none link-light" href="category.php?catid=<?php echo htmlentities($row['cid']) ?>" style="color:#fff"><?php echo htmlentities($row['category']); ?></a>
                                <!--Subcategory--->
                                <a class="badge bg-warning text-decoration-none link-light" style="color:#fff"><?php echo htmlentities($row['subcategory']); ?></a>
                            </p>
                            <p class="m-0"><small> Posted on <?php echo htmlentities($row['postingdate']); ?></small></p>
                            <a href="news-details.php?nid=<?php echo htmlentities($row['pid']) ?>" class="card-title text-decoration-none text-dark">
                                <h5 class="card-title"><?php echo htmlentities($row['posttitle']); ?></h5>
                            </a>
                            <!-- <a href="news-details.php?nid=<?php echo htmlentities($row['pid']) ?>" class="">Read More &rarr;</a> -->
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="col-md-12">


                <!-- Pagination -->
                <!-- <ul class="pagination justify-content-center mb-4">
                            <li class="page-item"><a href="?pageno=1"  class="page-link border-0">First</a></li>
                            <li class="<?php if ($pageno <= 1) {
                                            echo 'disabled';
                                        } ?> page-item">
                            <a href="<?php if ($pageno <= 1) {
                                            echo '#';
                                        } else {
                                            echo "?pageno=" . ($pageno - 1);
                                        } ?>" class="page-link border-0">Prev</a>
                            </li>
                            <li class="<?php if ($pageno >= $total_pages) {
                                            echo 'disabled';
                                        } ?> page-item">
                            <a href="<?php if ($pageno >= $total_pages) {
                                            echo '#';
                                        } else {
                                            echo "?pageno=" . ($pageno + 1);
                                        } ?> " class="page-link border-0">Next</a>
                            </li>
                            <li class="page-item"><a href="?pageno=<?php echo $total_pages; ?>" class="page-link border-0">Last</a></li>
                            </ul> -->
            </div>
        </div>
    </div>
    <!-- Sidebar Widgets Column -->
    <?php include('sidebar.php'); ?>
</div>