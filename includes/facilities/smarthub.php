<!-- Smart Hub Section -->
<div class="smart-hub-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6" data-aos="fade-right" data-aos-duration="1200">
                <h2 class="mb-4">Smart Hub</h2>
                <p class="lead">Our innovative Smart Hub is open to all students, offering a collaborative and technology-driven environment for learning.</p>
                <p>The Smart Hub provides students with:</p>
                <ul class="list-unstyled mt-4">
                    <li class="mb-3"><i class="fas fa-check-circle mr-2 text-warning"></i> Advanced research stations</li>
                    <li class="mb-3"><i class="fas fa-check-circle mr-2 text-warning"></i> Collaborative workspaces</li>
                    <li class="mb-3"><i class="fas fa-check-circle mr-2 text-warning"></i> Development environment</li>
                    <li class="mb-3"><i class="fas fa-check-circle mr-2 text-warning"></i> 8 am - 5 pm hours access for all students</li>
                    <li class="mb-3"><i class="fas fa-check-circle mr-2 text-warning"></i> Open for use by all courses</li>
                </ul>
                <!-- <button class="btn btn-light mt-3 bounce-animation">Take a Virtual Tour</button> -->
            </div>
            <div class="col-md-6" data-aos="fade-left" data-aos-duration="1200">
                <!-- Add "preview-img" class to make it clickable -->
                <img src="images/facilities/smarthub.jpeg" alt="Smart Hub" class="img-fluid rounded preview-img">
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