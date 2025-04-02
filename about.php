<?php

include( 'config/config.php' );
include( 'includes/header.php' );

$query_user = 'SELECT * FROM users';
$result_user = mysqli_query( $connect, $query_user );
$res_data_user = mysqli_fetch_assoc($result_user);

$query_skills = 'SELECT * FROM skills';
$result_skills = mysqli_query( $connect, $query_skills );


$user_data = getUserData();

?>

<main class="my-5">
  
  <section class="container section-about mb-5">

    <div class="row">
      <div class="col-md-12 text-center">
        <h2 class="mb-5 page-title">About</h2>
      </div>
    </div>
    
    <div class="row gy-4 justify-content-center">
      <div class="col-lg-4 d-flex align-items-center">
      <?php
        if (is_array($user_data)) {
          echo "<img src='admin/" . htmlspecialchars($user_data['image']) . "' class='img-fluid' alt='User Photo'>";
        } else {
            echo $user_data;
        }
      ?>
        <!-- <img src="assets/images/profile-img.jpg" class="img-fluid" alt="Profile Images"> -->
      </div>
      <div class="col-lg-8 d-flex align-items-center">
        <div>
          <h2 class="pb-3"><?=$res_data_user['designation']; ?></h2>
          <div class="row">
            <div class="col-lg-6">
              <ul class="list-unstyled">
                <li><i class="fa fa-angle-right"></i> <strong>Website:</strong> <span><?=$res_data_user['website']; ?></span></li>
                <li><i class="fa fa-angle-right"></i> <strong>Phone:</strong> <span><?=$res_data_user['phone']; ?></span></li>
                <li><i class="fa fa-angle-right"></i> <strong>City:</strong> <span><?=$res_data_user['city']; ?></span></li>
              </ul>
            </div>
            <div class="col-lg-6">
              <ul class="list-unstyled">
                <li><i class="fa fa-angle-right"></i> <strong>Degree:</strong> <span><?=$res_data_user['degree']; ?></span></li>
                <li><i class="fa fa-angle-right"></i> <strong>Email:</strong> <span><?=$res_data_user['email']; ?></span></li>
                <li><i class="fa fa-angle-right"></i> <strong>Freelance:</strong> <span><?=($res_data_user['freelance']==1?'Available':'Not-Available'); ?></span></li>
              </ul>
            </div>
          </div>
          <p class="py-3"><?=$res_data_user['description']; ?></p>
        </div>
      </div>
    </div>

  </section>
  
  
  <section class="container section-skills">

    <div class="row">
      <div class="col-md-12 text-center">
        <h2 class="mb-3 page-title">Skills</h2>
      </div>
    </div>
    
    <div class="row gy-4 justify-content-center">

      <?php while($record_skills = mysqli_fetch_assoc($result_skills)): ?>

        <div class="col-lg-6">
          <div class="progress-block">
            <div class="d-flex justify-content-between">
              <snap><?=$record_skills['title']; ?></snap> <span><?=$record_skills['proficiency']; ?>%</span>
            </div>
            <div class="progress">
              <div class="progress-bar" role="progressbar" aria-valuenow="<?=$record_skills['proficiency']; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?=$record_skills['proficiency']; ?>%"></div>
            </div>
          </div>
        </div>

      <?php endwhile; ?>

    </div>

  </section>

  </main>
  
  <?php
    include( 'includes/footer.php' );
  ?>