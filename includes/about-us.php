<?php
$pagetype = 'aboutus';
$query = mysqli_query($con, "SELECT PageTitle, Description FROM tblpages WHERE PageName='$pagetype'");
while ($row = mysqli_fetch_array($query)) {
?>

<div class="page-section py-5">
    <div class="container">
        <div class="row align-items-stretch">
            <!-- Image Section -->
            <div class="col-lg-6 col-md-12 mb-4 wow fadeInLeft">
                <div class="image-container rounded shadow-lg">
                    <img src="./assets/faculty_image/whole.jpg" alt="About Us Image" class="img-fluid w-100 h-100">
                </div>
            </div>

            <!-- Text Section -->
            <div class="col-lg-6 col-md-12 wow fadeInUp">
                <div class="content-box p-4 rounded shadow-lg">
                    <h1 class="mb-4 text-center text-uppercase text-dark fw-bold">
                        <?php echo htmlentities($row['PageTitle']); ?>
                    </h1>
                    <div class="text-lg">
                        <?php
                        $plainText = strip_tags($row['Description']);
                        $paragraphs = explode("\n", trim($plainText));
                        ?>
                        <div id="about-text" class="text-justify">
                            <?php
                            foreach ($paragraphs as $para) {
                                if (!empty(trim($para))) {
                                    echo '<p class="text-dark mb-3">' . htmlentities($para) . '</p>';
                                }
                            }
                            ?>
                        </div>
                        <div class="text-center">
                            <button id="toggle-btn" class="btn btn-primary btn-sm mt-3">Read More</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php } ?>

<style>
    .image-container,
    .content-box {
        height: 100%; /* Equal height */
        background: white;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        overflow: hidden;
        display: flex;
        align-items: center; /* Align content vertically */
        justify-content: center; /* Align content horizontally */
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .image-container img {
        object-fit: cover; /* Maintain aspect ratio */
        width: 100%;
        height: 100%;
    }

    .content-box:hover,
    .image-container:hover {
        transform: scale(1.02);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .text-justify {
        text-align: justify;
        overflow: hidden;
        max-height: 300px; /* Default height */
        transition: max-height 0.8s ease-in-out, opacity 0.8s ease-in-out; /* Smooth transition */
        opacity: 1;
    }

    .text-justify.open {
        max-height: 1000px; /* Large height for full content */
        opacity: 1;
    }

    .text-justify.closed {
        max-height: 300px;
        opacity: 0.8;
    }

    @media (max-width: 768px) {
        .image-container,
        .content-box {
            margin-bottom: 20px;
            height: auto;
        }

        .text-justify {
            max-height: none; /* Remove fixed height on small screens */
        }
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const toggleBtn = document.getElementById("toggle-btn");
        const aboutText = document.getElementById("about-text");

        toggleBtn.addEventListener("click", function () {
            if (aboutText.classList.contains("open")) {
                aboutText.classList.remove("open");
                aboutText.classList.add("closed");
                toggleBtn.textContent = "Read More";
            } else {
                aboutText.classList.remove("closed");
                aboutText.classList.add("open");
                toggleBtn.textContent = "Read Less";
            }
        });
    });
</script>
