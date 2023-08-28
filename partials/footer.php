<?php
$commonFooter = ' <footer class="bg-white text-black text-center py-1 mt-5">
    <p>&copy; 2023 PharmyLand. All rights reserved.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelector(".loader-wrapper").style.display = "flex";
});
window.addEventListener("beforeunload", function() {
  document.querySelector(".loader-wrapper").style.display = "flex";
});

// Hide the loader when all resources (images, stylesheets, etc.) are loaded
window.addEventListener("load", function() {
    document.querySelector(".loader-wrapper").style.display = "none";
});
</script>';
  
?>