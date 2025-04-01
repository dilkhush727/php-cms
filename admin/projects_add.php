<?php

include( '../config/config.php' );

secure();

if (isset($_POST['title'])) {
  
  if ($_POST['title'] && $_POST['content']) {

      $photoPath = ''; // Default empty photo path

      // Check if a file is uploaded
      if (!empty($_FILES['photo']['name'])) {
          $uploadDir = 'uploads/';
          $fileExt = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION); // Get file extension
          $randomFileName = uniqid('img_') . '.' . $fileExt; // Generate a unique random filename
          $targetFile = $uploadDir . $randomFileName;

          // Ensure the uploads directory exists
          if (!is_dir($uploadDir)) {
              mkdir($uploadDir, 0777, true);
          }

          // Move the uploaded file
          if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile)) {
              $photoPath = $targetFile; // Save file path
          } else {
              echo "Error uploading file.";
              die(); // Stop script if file upload fails
          }
      }

      // Insert into database
      $query = 'INSERT INTO projects (
          title,
          content,
          date,
          type,
          url,
          photo
      ) VALUES (
          "' . mysqli_real_escape_string($connect, $_POST['title']) . '",
          "' . mysqli_real_escape_string($connect, $_POST['content']) . '",
          "' . mysqli_real_escape_string($connect, $_POST['date']) . '",
          "' . mysqli_real_escape_string($connect, $_POST['type']) . '",
          "' . mysqli_real_escape_string($connect, $_POST['url']) . '",
          "' . mysqli_real_escape_string($connect, $photoPath) . '"
      )';

      mysqli_query($connect, $query);
      
      set_message('Project has been added');
  }

  header('Location: projects.php');
  die();
}


include( 'includes/header.php' );

?>



<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" id="main-admin">
  <div class="pt-3 pb-2 mb-3">
    <h1 class="h2">Add Project</h1>
  </div>

  <form method="post" enctype="multipart/form-data">

  <div class="mb-3">
    <label for="title">Title:</label>
    <input type="text" name="title" id="title" class="form-control" required>
  </div>

  <div class="mb-3">
    <label for="content">Content:</label>
    <textarea type="text" name="content" id="content" rows="10" class="form-control"></textarea>
  </div>
    
    <script>

    ClassicEditor
      .create( document.querySelector( '#content' ) )
      .then( editor => {
          console.log( editor );
      } )
      .catch( error => {
          console.error( error );
      } );
      
    </script>

    <div class="mb-3">
      <label for="url">URL:</label>
      <input type="text" name="url" id="url" class="form-control">
    </div>

    <div class="mb-3">
      <label for="date">Date:</label>
      <input type="date" name="date" id="date" class="form-control">
    </div>

    <div class="mb-3">
      <label for="type">Type:</label>
        <?php
        
        $values = array( 'Website', 'Graphic Design' );
        
        echo '<select name="type" id="type" class="form-control">';
        foreach( $values as $key => $value )
        {
          echo '<option value="'.$value.'"';
          echo '>'.$value.'</option>';
        }
        echo '</select>';
        
        ?>
    </div>

    <div class="mb-3">
      <label for="photo">Photo:</label>
      <input type="file" name="photo" id="photo" class="form-control">
    </div>

    <div class="mb-3 text-center">
      <a href="projects.php" class="btn btn-secondary"><i class="fas fa-arrow-circle-left"></i> Return to Project List</a>
      <input type="submit" class="btn btn-primary" value="Submit">
    </div>
    
  </form>

</main>



<?php

include( 'includes/footer.php' );

?>