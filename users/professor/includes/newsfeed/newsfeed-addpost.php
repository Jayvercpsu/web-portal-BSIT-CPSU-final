  <!-- Form to Add Post -->
  <div class="post-form">
      <form name="addpost" method="post" class="row mb-4" enctype="multipart/form-data">
          <div class="form-group">
              <textarea class="form-control post-textarea" id="posttext" name="posttext" rows="2" placeholder="What's on your mind?"></textarea>
          </div>
          <div class="form-actions">
              <label for="postimage" class="upload-btn">
                  <i class="fa fa-image"></i> Add Photo
                  <input type="file" id="postimage" name="postimage" accept="image/*" hidden>
              </label>
              <button type="submit" name="submit" class="btn btn-primary">Post</button>
          </div>
          <!-- Image Preview -->
          <div id="imagePreviewContainer" class="mt-3" style="display: none;">
              <img id="imagePreview" src="#" alt="Image Preview" class="img-fluid rounded" style="max-height: 300px; object-fit: cover;">
          </div>
      </form>
  </div>

  <!-- JavaScript for Image Preview -->
  <script>
      const postImageInput = document.getElementById('postimage');
      const imagePreviewContainer = document.getElementById('imagePreviewContainer');
      const imagePreview = document.getElementById('imagePreview');

      postImageInput.addEventListener('change', function(event) {
          const file = event.target.files[0];
          if (file) {
              const reader = new FileReader();
              reader.onload = function(e) {
                  imagePreview.src = e.target.result;
                  imagePreviewContainer.style.display = 'block';
              };
              reader.readAsDataURL(file);
          } else {
              imagePreviewContainer.style.display = 'none';
          }
      });
  </script>