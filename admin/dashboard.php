<?php
  include( '../config/config.php' );

  secure();

  include( 'includes/header.php' );



  // Query to get total contacts from the contact_us table
  $contactQuery = 'SELECT COUNT(*) AS total_contacts FROM contact_us';
  $contactResult = mysqli_query($connect, $contactQuery);
  $contactData = mysqli_fetch_assoc($contactResult);
  $totalContacts = $contactData['total_contacts'];

  // Query to get total projects from the projects table
  $projectQuery = 'SELECT COUNT(*) AS total_projects FROM projects';
  $projectResult = mysqli_query($connect, $projectQuery);
  $projectData = mysqli_fetch_assoc($projectResult);
  $totalProjects = $projectData['total_projects'];

  // Query to get total skills from the skills table
  $skillsQuery = 'SELECT COUNT(*) AS total_skills FROM skills';
  $skillsResult = mysqli_query($connect, $skillsQuery);
  $skillsData = mysqli_fetch_assoc($skillsResult);
  $totalSkills = $skillsData['total_skills'];



  // Get User Image
  $user_id = isset($_SESSION['id']) ? $_SESSION['id'] : null;  // Get user ID from session
  $user_data = getUserData($user_id);

?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" id="main-admin">
  <div class="pt-3 pb-2 mb-3">
    <h1 class="h2">Dashboard</h1>
  </div>



  <section class="dash-overview">
    <div class="row g-4">
      <div class="col-lg-3 col-md-3 col-sm-4">
        <a href="<?=base_url('admin/'); ?>projects.php" class="card">
          <h1><?=$totalProjects; ?></h1>
          <p>Projects</p>
        </a>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-4">
        <a href="<?=base_url('admin/'); ?>contact.php" class="card">
          <h1><?=$totalContacts; ?></h1>
          <p>Contact Us</p>
        </a>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-4">
        <a href="<?=base_url('admin/'); ?>skills.php" class="card">
          <h1><?=$totalSkills; ?></h1>
          <p>Skills</p>
        </a>
      </div>
    </div>
  </section>

  <section class="mt-5 py-3 dash-profile">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-12 col-12 d-flex align-items-center">

        <?php
            if (is_array($user_data)) {
              echo "<img src='" . htmlspecialchars($user_data['image']) . "' class='rounded-circle user-image' alt='User Photo' width='100'>";
          } else {
              echo $user_data;
          }
        ?>

        </div>
        <div class="col-lg-9 col-md-8 col-sm-12 col-12 d-flex align-items-center mt-2">
          <div>
            <h5 class="title-small"><?=$user_data['title_small']; ?></h5>
            <h2><?=$user_data['title_main']; ?></h2>

            <div>
              <?php if (!empty($user_data['audio'])): ?>
                <div class="audio-player-container">
                  <audio id="audioPlayer" controls>
                    <source src="<?php echo $user_data['audio']; ?>" type="audio/mpeg">
                    Your browser does not support the audio element.
                  </audio>
                </div>

                <div class="audio-player-container">
                  <button id="playPauseBtn" class="play-btn">Play Introduction</button>
                </div>
              <?php endif; ?>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </section>



  
</main>

<?php
  include( 'includes/footer.php' );
?>