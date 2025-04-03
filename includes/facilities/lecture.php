<!-- Classroom Facilities -->
<div class="classroom-section">
    <div class="container">
        <h2 class="text-center section-title" data-aos="fade-up">Lecture Rooms</h2>
        <p class="text-center mb-5" data-aos="fade-up" data-aos-delay="200">Modern classrooms designed for easy learning, reporting, and collaboration.</p>

        <div class="row">
            <!-- Classroom A1 -->
            <div class="col-md-6" data-aos="flip-left" data-aos-duration="1000">
                <div class="facility-card wow fadeInLeft">
                    <span class="room-badge">Room A1</span>
                    <!-- Added "preview-img" class -->
                    <img src="images/facilities/a1.jpeg" alt="Classroom A1" class="facility-img preview-img">
                    <div class="facility-detail">
                        <h5>Interactive Lecture Room</h5>
                        <p>Equipped with a monitor screen for class presentations and internet connection for easy access to resources.</p>
                    </div>
                </div>
            </div>

            <!-- Classroom A2 -->
            <div class="col-md-6" data-aos="flip-right" data-aos-duration="1000">
                <div class="facility-card wow fadeInRight">
                    <span class="room-badge">Room A2</span>
                    <!-- Added "preview-img" class -->
                    <img src="images/facilities/a2.jpeg" alt="Classroom A2" class="facility-img preview-img">
                    <div class="facility-detail">
                        <h5>Collaborative Learning Space</h5>
                        <p>Perfect for group work, presentations, and easy access to internet resources using the large monitor screen in front.</p>
                    </div>
                </div>
            </div>
        </div>
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