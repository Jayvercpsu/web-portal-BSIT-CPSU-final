    <!-- Laboratory Facilities -->
    <div class="lab-section">
        <div class="container">
            <h2 class="text-center section-title" data-aos="fade-up">Computer Laboratories</h2>
            <p class="text-center mb-5" data-aos="fade-up" data-aos-delay="200">State-of-the-art learning environments equipped with the latest technology for hands-on experiences.</p>

            <div class="row">
                <!-- Lab 1 -->
                <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="100">
                    <div class="facility-card wow fadeIn">
                        <span class="room-badge">Lab 1</span>
                        <img src="images/facilities/lab1.jpeg" alt="Laboratory 1" class="facility-img preview-img">
                        <div class="facility-detail">
                            <h5>Programming Laboratory</h5>
                            <p>Equipped with high-performance computers for coding and programming practices.</p>
                        </div>
                    </div>
                </div>

                <!-- Lab 2 -->
                <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="200">
                    <div class="facility-card wow fadeIn">
                        <span class="room-badge">Lab 2</span>
                        <img src="images/facilities/lab2.jpeg" alt="Laboratory 2" class="facility-img preview-img">
                        <div class="facility-detail">
                            <h5>Networking Laboratory</h5>
                            <p>Specialized for network configuration and system administration training.</p>
                        </div>
                    </div>
                </div>

                <!-- Lab 3 -->
                <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="300">
                    <div class="facility-card wow fadeIn">
                        <span class="room-badge">Lab 3</span>
                        <img src="images/facilities/lab3.jpeg" alt="Laboratory 3" class="facility-img preview-img">
                        <div class="facility-detail">
                            <h5>Multimedia Laboratory</h5>
                            <p>Designed for graphic design, video editing, and digital content creation.</p>
                        </div>
                    </div>
                </div>

                <!-- Lab 4 -->
                <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="400">
                    <div class="facility-card wow fadeIn">
                        <span class="room-badge">Lab 4</span>
                        <img src="images/facilities/lab4.jpeg" alt="Laboratory 4" class="facility-img preview-img">
                        <div class="facility-detail">
                            <h5>Database & Development Lab</h5>
                            <p>Focused on database management and software development projects.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Preview Popup -->
    <div id="imagePreview" class="image-preview">
        <div class="image-container">
            <span class="close" onclick="closePreview()">&times;</span>
            <img class="image-preview-content" id="previewImg">
        </div>
    </div>

    <script>
        document.querySelectorAll('.preview-img').forEach(img => {
            img.addEventListener('click', function() {
                document.getElementById('previewImg').src = this.src;
                let preview = document.getElementById('imagePreview');
                preview.style.display = 'flex'; // Ensure it appears
                setTimeout(() => {
                    preview.classList.add('show');
                }, 10);
            });
        });

        function closePreview() {
            let preview = document.getElementById('imagePreview');
            preview.classList.remove('show');
            setTimeout(() => {
                preview.style.display = 'none';
            }, 300);
        }
    </script>