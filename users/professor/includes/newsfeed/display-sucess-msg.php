   <!-- Display success or error message -->
   <?php if (isset($_SESSION['msg'])): ?>
       <div class="alert alert-success" id="success-msg">
           <?php
            echo $_SESSION['msg'];
            unset($_SESSION['msg']); // Clear message after displaying
            ?>
       </div>
   <?php endif; ?>

   <?php if (isset($_SESSION['error'])): ?>
       <div class="alert alert-danger" id="error-msg">
           <?php
            echo $_SESSION['error'];
            unset($_SESSION['error']); // Clear message after displaying
            ?>
       </div>
   <?php endif; ?>

   <script>
       // Hide success message after 2 seconds
       setTimeout(function() {
           var successMsg = document.getElementById("success-msg");
           if (successMsg) {
               successMsg.style.display = "none";
           }
       }, 2000);

       // Hide error message after 2 seconds
       setTimeout(function() {
           var errorMsg = document.getElementById("error-msg");
           if (errorMsg) {
               errorMsg.style.display = "none";
           }
       }, 2000);
   </script>