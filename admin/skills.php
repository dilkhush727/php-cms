<?php

include('../config/config.php');

secure();

if (isset($_POST['title'])) {
  
  // Update existing skills
  if (isset($_POST['title'])) {
    foreach ($_POST['title'] as $id => $title) {
      $query = 'UPDATE skills SET
          title = "' . mysqli_real_escape_string($connect, $title) . '",
          proficiency = ' . mysqli_real_escape_string($connect, $_POST['proficiency'][$id]) . '
          WHERE id = ' . $id . ' LIMIT 1';
      mysqli_query($connect, $query);
    }
  }

  // Add new skills
  if (isset($_POST['title'])) {

        $deleteQuery = 'DELETE FROM skills';
        mysqli_query($connect, $deleteQuery);
    
    foreach ($_POST['title'] as $index => $title) {
      if ($title && isset($_POST['proficiency'][$index])) {
        $query = 'INSERT INTO skills (title, proficiency) VALUES (
          "' . mysqli_real_escape_string($connect, $title) . '",
          ' . mysqli_real_escape_string($connect, $_POST['proficiency'][$index]) . '
        )';
        mysqli_query($connect, $query);
      }
    }
  }

  set_message('Skills have been updated');
  header('Location: skills.php');
  die();
}

// Fetch existing skills
$query = 'SELECT * FROM skills';
$result = mysqli_query($connect, $query);
$skills = mysqli_fetch_all($result, MYSQLI_ASSOC);

include('includes/header.php');

?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" id="main-admin">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <h1 class="h2">Skills</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
    <!-- <a href="projects_add.php" class="btn-cta"><i class="fas fa-plus-square"></i> Add More</a> -->

    <div class="text-center">
      <button id="add-more" class="btn btn-success"><i class="fas fa-plus-square"></i> Add More Skills</button>
    </div>
    
    </div>
  </div>

  <form method="post" enctype="multipart/form-data">

    <!-- Display existing skills for editing -->
    <div id="existing-skills">
      <?php foreach ($skills as $skill): ?>
        <div class="mb-3 skill-group">
          <div>
            <input type="text" name="title[<?php echo $skill['id']; ?>]" value="<?php echo htmlentities($skill['title']); ?>" class="form-control" placeholder="Skill Title" required>
          </div>

          <div>
            <input type="number" name="proficiency[<?php echo $skill['id']; ?>]" value="<?php echo htmlentities($skill['proficiency']); ?>" class="form-control" placeholder="Skill Proficiency" required>
          </div>
          <div>
            <button type="button" class="remove-skill-btn btn btn-danger"><i class="fas fa-times"></i></button>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Add new skill section -->
    <div id="new-skills">
      <div class="mb-3 skill-group">
        <div>
          <input type="text" name="title[]" class="form-control" placeholder="Skill Title" required>
        </div>

        <div>
          <input type="number" name="proficiency[]" class="form-control" placeholder="Skill Proficiency" required>
        </div>
        <div>
          <button type="button" class="remove-skill-btn btn btn-danger"><i class="fas fa-times"></i></button>
        </div>
      </div>
    </div>

    <div class="mb-3 mt-5">
      <a href="skills.php" class="btn btn-secondary"><i class="fas fa-arrow-circle-left"></i> Return to Skills List</a>
      <input type="submit" class="btn btn-primary" value="Submit">
    </div>

  </form>

  

</main>

<?php

include('includes/footer.php');

?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  // Add More Skills functionality
  $('#add-more').on('click', function() {
    var newSkillHTML = `
      <div class="mb-3 skill-group">
      <div><input type="text" name="title[]" class="form-control" placeholder="Skill Title" required></div>
        
      <div><input type="number" name="proficiency[]" class="form-control" placeholder="Skill Proficiency" required></div>
          
      <div><button type="button" class="remove-skill-btn btn btn-danger"><i class="fas fa-times"></i></button></div>
        
      </div>
    `;
    $('#new-skills').append(newSkillHTML);
  });

  // Remove Skill functionality
  $(document).on('click', '.remove-skill-btn', function() {
    $(this).closest('.skill-group').remove();
  });
</script>
