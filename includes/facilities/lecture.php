<!-- Classroom Facilities -->
<div class="classroom-section">
    <div class="container">
        <h2 class="text-center section-title" data-aos="fade-up">Lecture Rooms</h2>
        <p class="text-center mb-5" data-aos="fade-up" data-aos-delay="200">Modern classrooms designed for effective learning and collaboration.</p>

        <div class="row">
            <!-- Classroom A1 -->
            <div class="col-md-6" data-aos="flip-left" data-aos-duration="1000">
                <div class="facility-card wow fadeInLeft">
                    <span class="room-badge">Room A1</span>
                    <!-- Added "preview-img" class -->
                    <img src="images/facilities/a1.jpeg" alt="Classroom A1" class="facility-img preview-img">
                    <div class="facility-detail">
                        <h5>Interactive Lecture Room</h5>
                        <p>Modern classroom with interactive teaching tools and flexible seating arrangements.</p>
                        <div class="row mt-3">
                            <div class="col-6 d-flex align-items-center mb-2">
                                <i class="fas fa-users feature-icon animated-icon"></i>
                                <span>50 Capacity</span>
                            </div>
                            <div class="col-6 d-flex align-items-center mb-2">
                                <i class="fas fa-chalkboard feature-icon animated-icon"></i>
                                <span>Smart Board</span>
                            </div>
                            <div class="col-6 d-flex align-items-center">
                                <i class="fas fa-wifi feature-icon animated-icon"></i>
                                <span>High-Speed WiFi</span>
                            </div>
                            <div class="col-6 d-flex align-items-center">
                                <i class="fas fa-air-conditioner feature-icon animated-icon"></i>
                                <span>Air Conditioned</span>
                            </div>
                        </div>
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
                        <p>Designed specifically for group work, presentations, and collaborative projects.</p>
                        <div class="row mt-3">
                            <div class="col-6 d-flex align-items-center mb-2">
                                <i class="fas fa-users feature-icon animated-icon"></i>
                                <span>40 Capacity</span>
                            </div>
                            <div class="col-6 d-flex align-items-center mb-2">
                                <i class="fas fa-projector feature-icon animated-icon"></i>
                                <span>Projector Systems</span>
                            </div>
                            <div class="col-6 d-flex align-items-center">
                                <i class="fas fa-plug feature-icon animated-icon"></i>
                                <span>Power Stations</span>
                            </div>
                            <div class="col-6 d-flex align-items-center">
                                <i class="fas fa-microphone feature-icon animated-icon"></i>
                                <span>Audio System</span>
                            </div>
                        </div>
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