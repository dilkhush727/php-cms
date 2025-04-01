<?php

include( 'config/config.php' );
include( 'includes/header.php' );


// Get User Image
$user_id = isset($_SESSION['id']) ? $_SESSION['id'] : null;  // Get user ID from session
$user_data = getUserData($user_id);

?>




<main class="mt-5">



<div class="container home-banner">
  <div class="row">
    <div class="col-lg-6 col-md-5 col-sm-12 col-12 d-flex align-items-center justify-content-center">

    <?php
        if (is_array($user_data)) {
          echo "<img src='admin/" . htmlspecialchars($user_data['image']) . "' class='rounded-circle user-image-home' alt='User Photo'>";
      } else {
          echo $user_data;
      }
    ?>
    
      <!-- <img src="assets/images/profile-img.jpg" class="rounded-circle w-100" alt="Profile Picture"> -->
    </div>
    <div class="col-lg-6 col-md-7 col-sm-12 col-12 d-flex align-items-center justify-content-center mt-3">
      <div>
        <h5 class="title-small"><?=$user_data['title_small']; ?></h5>
        <h2 class="title-home"><?=$user_data['title_main']; ?></h2>
      </div>
    </div>
  </div>
</div>

</main>
  
  <?php
    include( 'includes/footer.php' );
  ?>