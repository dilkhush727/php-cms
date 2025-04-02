<?php

include( '../config/config.php' );

secure();

if( !isset( $_GET['id'] ) )
{
  
  header( 'Location: projects.php' );
  die();
  
}

if (isset($_POST['title'])) {

  if ($_POST['title'] && $_POST['content']) {

      // Start building the update query
      $query = 'UPDATE projects SET
          title = "' . mysqli_real_escape_string($connect, $_POST['title']) . '",
          content = "' . mysqli_real_escape_string($connect, $_POST['content']) . '",
          date = "' . mysqli_real_escape_string($connect, $_POST['date']) . '",
          type = "' . mysqli_real_escape_string($connect, $_POST['type']) . '",
          url = "' . mysqli_real_escape_string($connect, $_POST['url']) . '",
          youtube_link = "' . mysqli_real_escape_string($connect, $_POST['youtube_link']) . '"';

      // Check if a new file was uploaded
      if (!empty($_FILES['photo']['name'])) {
          $uploadDir = 'uploads/'; // Ensure this directory exists
          $fileExt = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION); // Get file extension
          $randomFileName = uniqid('img_') . '.' . $fileExt; // Generate a unique filename
          $targetFile = $uploadDir . $randomFileName;

          // Ensure uploads directory exists
          if (!is_dir($uploadDir)) {
              mkdir($uploadDir, 0777, true);
          }

          // Fetch existing photo from the database
          $photoQuery = 'SELECT photo FROM projects WHERE id = ' . $_GET['id'] . ' LIMIT 1';
          $photoResult = mysqli_query($connect, $photoQuery);
          $photoRecord = mysqli_fetch_assoc($photoResult);

          if (!empty($photoRecord['photo']) && file_exists($photoRecord['photo'])) {
              unlink($photoRecord['photo']); // Delete the existing file
          }

          // Move uploaded file
          if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile)) {
              $query .= ', photo = "' . mysqli_real_escape_string($connect, $targetFile) . '"';
          } else {
              echo "Error uploading file.";
              die(); // Stop script if file upload fails
          }
      }

      // Complete the query
      $query .= ' WHERE id = ' . $_GET['id'] . ' LIMIT 1';

      // Execute the query
      mysqli_query($connect, $query);

      set_message('Project has been updated');
  }

  header('Location: projects.php');
  die();
}

// Fetch project data
if (isset($_GET['id'])) {
  $query = 'SELECT * FROM projects WHERE id = ' . $_GET['id'] . ' LIMIT 1';
  $result = mysqli_query($connect, $query);

  if (!mysqli_num_rows($result)) {
      header('Location: projects.php');
      die();
  }

  $record = mysqli_fetch_assoc($result);
}


include( 'includes/header.php' );

?>



<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" id="main-admin">
  <div class="pt-3 pb-2 mb-3">
    <h1 class="h2">Edit Project</h1>
  </div>

  <form method="post" enctype="multipart/form-data">

    <div class="mb-3">
      <label for="title">Title:</label>
      <input type="text" name="title" id="title" value="<?php echo htmlentities( $record['title'] ); ?>" class="form-control" required>
    </div>
    
    <div class="mb-3">
      <label for="content">Content:</label>
      <textarea type="text" name="content" id="content" rows="5" class="form-control" placeholder="Content" required><?php echo htmlentities( $record['content'] ); ?></textarea>
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
    
    

    <div class="row">
      <div class="col-md-6 mb-3">
        <label for="url">URL:</label>
        <input type="text" name="url" id="url" value="<?php echo htmlentities( $record['url'] ); ?>" class="form-control" placeholder="Title">
      </div>
      <div class="col-md-6 mb-3">
        <label for="url">You Tube Embed Link:</label>
        <input type="text" name="youtube_link" id="youtube_link" value="<?php echo htmlentities( $record['youtube_link'] ); ?>" class="form-control" placeholder="You Tube Embed Link">
      </div>
    </div>

    <div class="row">
      <div class="col-md-6 mb-3">
        <label for="date">Date:</label>
        <input type="date" name="date" id="date" value="<?php echo htmlentities( $record['date'] ); ?>" class="form-control">
      </div>
      <div class="col-md-6 mb-3">
        <label for="type">Type:</label>
        <?php
        
        $values = array( 'Website', 'Graphic Design' );
        
        echo '<select name="type" id="type" class="form-control">';
        foreach( $values as $key => $value )
        {
          echo '<option value="'.$value.'"';
          if( $value == $record['type'] ) echo ' selected="selected"';
          echo '>'.$value.'</option>';
        }
        echo '</select>';
        
        ?>
      </div>
    </div>

  <!-- Display Existing Image -->
  <div class="mb-3">
    <?php if (!empty($record['photo'])): ?>
      <img src="<?php echo htmlentities($record['photo']); ?>" alt="Project Image" width="150">
    <?php else: ?>
      <p class="text-danger">No image uploaded</p>
    <?php endif; ?>
  </div>

  <!-- Upload New Image -->
  <div class="mb-3">
    <label for="photo">Upload New Photo:</label>
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