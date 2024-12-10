       <!-- Edit Post Modal -->
       <div class="modal fade" id="editPostModal" tabindex="-1" role="dialog" aria-labelledby="editPostModalLabel" aria-hidden="true">
           <div class="modal-dialog" role="document">
               <div class="modal-content">
                   <form method="post" enctype="multipart/form-data">
                       <div class="modal-header">
                           <h5 class="modal-title" id="editPostModalLabel">Edit Post</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                           </button>
                       </div>
                       <div class="modal-body">
                           <input type="hidden" name="edit_post_id" id="edit_post_id">
                           <div class="form-group">
                               <label for="edit_posttext">Edit Content</label>
                               <textarea class="form-control" name="edit_posttext" id="edit_posttext" rows="3"></textarea>
                           </div>
                           <div class="form-group">
                               <label for="edit_postimage">Change Photo</label>
                               <input type="file" class="form-control-file" name="edit_postimage" id="edit_postimage" accept="image/*">
                           </div>
                           <!-- Image Preview -->
                           <div id="editImagePreviewContainer" class="text-center mt-3" style="display: none;">
                               <img id="editImagePreview" src="#" alt="Image Preview" class="img-fluid rounded" style="max-height: 300px; object-fit: cover;">
                           </div>
                       </div>
                       <div class="modal-footer">
                           <button type="submit" name="edit_post" class="btn btn-primary">Save Changes</button>
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                       </div>
                   </form>
               </div>
           </div>
       </div>

       <script>
           // Function to preview image when editing a post
           document.getElementById('edit_postimage').addEventListener('change', function(event) {
               const file = event.target.files[0];
               const previewContainer = document.getElementById('editImagePreviewContainer');
               const previewImage = document.getElementById('editImagePreview');

               if (file) {
                   const reader = new FileReader();
                   reader.onload = function(e) {
                       previewContainer.style.display = 'block';
                       previewImage.src = e.target.result;
                   };
                   reader.readAsDataURL(file);
               } else {
                   previewContainer.style.display = 'none';
                   previewImage.src = '#';
               }
           });

           // Function to open the edit modal and populate existing data
           function openEditModal(postId, content, imageSrc) {
               document.getElementById('edit_post_id').value = postId;
               document.getElementById('edit_posttext').value = content;

               const previewContainer = document.getElementById('editImagePreviewContainer');
               const previewImage = document.getElementById('editImagePreview');

               if (imageSrc) {
                   previewContainer.style.display = 'block';
                   previewImage.src = imageSrc;
               } else {
                   previewContainer.style.display = 'none';
                   previewImage.src = '#';
               }

               $('#editPostModal').modal('show');
           }
       </script>