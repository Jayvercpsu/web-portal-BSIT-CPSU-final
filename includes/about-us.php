<?php
$pagetype = 'aboutus';
$query = mysqli_query($con, "SELECT PageTitle, Description FROM tblpages WHERE PageName='$pagetype'");
while ($row = mysqli_fetch_array($query)) {
?>

<div class="page-section" style="display: flex; align-items: center; padding: 50px 0;">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Image on the left side -->
            <div class="col-lg-6 col-md-6 col-sm-12 wow fadeInLeft"
                style="background-image: url('./assets/faculty_image/whole.jpg'); 
                       background-size: cover; 
                       background-position: center; 
                       height: 620px; 
                       width: 100%;
                       margin-top: 60px;
                       background-color: #ddd; /* Default color in case image fails */
                       border-radius: 10px;">
            </div>

            <!-- Text content on the right side -->
            <div class="col-lg-6 col-md-6 col-sm-12 wow fadeInUp"
                style="background-color: rgba(0, 0, 0, 0.5); padding: 20px; border-radius: 10px;">
                
                <h1 class="mt-5 mb-3 text-center text-white">
                    <?php echo htmlentities($row['PageTitle']); ?>
                </h1>

                <div class="text-lg">
                    <div class="row">
                        <div class="col-12">
                            <?php 
                                // Remove all HTML tags and split into paragraphs
                                $plainText = strip_tags($row['Description']); 
                                $paragraphs = explode("\n", trim($plainText)); // Split by new lines
                                
                                foreach ($paragraphs as $para) {
                                    if (!empty(trim($para))) { // Avoid empty paragraphs
                                        echo '<p class="text-white text-justify">' . htmlentities($para) . '</p>';
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>

            </div> <!-- End of text section -->
        </div>
    </div>
</div>

<?php } ?>

<style>
    .text-justify {
    text-align: justify;
}

</style>