<div class="col-md-3">
    <!-- Search Widget -->
    <div class="card mb-4 border-0">
        <h5 class="card-header border-0 bg-white">Search</h5>
        <div class="card-body">
            <form name="search" action="search.php" method="post">
                <div class="input-group">
                    <input type="text" name="searchtitle" class="form-control rounded-0" placeholder="Search for..." required>
                    <button style="background-color: #6a0dad;" class="btn text-white rounded-0" type="submit"><i class="fa fa-search"></i></button>
                </div>
            </form>
        </div>
    </div>

    <!-- Top Trending Widget -->
    <div class="card my-4 border-0">
        <h5 class="card-header border-0 bg-dark text-white">Top Trending</h5>
        <div class="card-body">
            <ul class="mb-0 list-unstyled">
                <?php
                $query = mysqli_query($con, "SELECT id AS pid, PostImage, PostTitle FROM tblposts WHERE Is_Active = 1 ORDER BY viewCounter DESC LIMIT 8");
                while ($row = mysqli_fetch_array($query)) {
                    $imagePath = !empty($row['PostImage']) ? "admin/postimages/" . htmlentities($row['PostImage']) : "assets/img/default-news.jpg";
                ?>
                    <li class="d-flex mb-2 align-items-center">
                        <img class="mr-2 rounded" src="<?php echo $imagePath; ?>" alt="<?php echo htmlentities($row['PostTitle']); ?>" width="50px" height="50px">
                        <a href="news-details.php?nid=<?php echo htmlentities($row['pid']); ?>" class="text-dark font-weight-bold post-title"><?php echo htmlentities($row['PostTitle']); ?></a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>

    <!-- Recent News Widget -->
    <div class="card my-4 border-0">
        <h5 class="card-header border-0 bg-dark text-white">Recent News</h5>
        <div class="card-body">
            <ul class="mb-0 list-unstyled">
                <?php
                $query = mysqli_query($con, "SELECT id AS pid, PostImage, PostTitle FROM tblposts WHERE Is_Active = 1 ORDER BY PostingDate DESC LIMIT 8");
                while ($row = mysqli_fetch_array($query)) {
                    $imagePath = !empty($row['PostImage']) ? "admin/postimages/" . htmlentities($row['PostImage']) : "assets/img/default-news.jpg";
                ?>
                    <li class="d-flex mb-2 align-items-center">
                        <img class="mr-2 rounded-circle" src="<?php echo $imagePath; ?>" alt="<?php echo htmlentities($row['PostTitle']); ?>" width="50px" height="50px">
                        <a href="news-details.php?nid=<?php echo htmlentities($row['pid']); ?>" class="text-dark font-weight-bold post-title"><?php echo htmlentities($row['PostTitle']); ?></a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>

<!-- ✅ CSS Enhancements -->
<style>
    .post-title {
        transition: color 0.3s ease;
    }
    .post-title:hover {
        color: #6a0dad;
    }
</style>
