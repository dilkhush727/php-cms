<?php

include( '../config/config.php' );

secure();

if( isset( $_GET['delete'] ) )
{
  
  $query = 'DELETE FROM projects
    WHERE id = '.$_GET['delete'].'
    LIMIT 1';
  mysqli_query( $connect, $query );
    
  set_message( 'Project has been deleted' );
  
  header( 'Location: projects.php' );
  die();
  
}

include( 'includes/header.php' );

$query = 'SELECT *
  FROM projects
  ORDER BY id DESC';
$result = mysqli_query( $connect, $query );

?>



<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" id="main-admin">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <h1 class="h2">Manage Projects</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
    <a href="projects_add.php" class="btn-cta"><i class="fas fa-plus-square"></i> Add Project</a>
    </div>
  </div>
  
  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th align="center">ID</th>
          <th></th>
          <th align="left">Title</th>
          <th align="center">Type</th>
          <th align="center">Date</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php while( $record = mysqli_fetch_assoc( $result ) ): ?>
          <tr>
            <td align="center"><?php echo $record['id']; ?></td>
            <td align="center">
            <?php if (!empty($record['photo'])): ?>
                <img src="<?php echo htmlentities($record['photo']); ?>" width="150" alt="Project Image">
            <?php else: ?>
                <p class="text-danger">No image found</p>
            <?php endif; ?>

            </td>
            <td align="left">
              <?php echo htmlentities( $record['title'] ); ?>
              <small><?php echo $record['content']; ?></small>
            </td>
            <td align="center"><?php echo $record['type']; ?></td>
            <td align="center" style="white-space: nowrap;"><?php echo htmlentities( $record['date'] ); ?></td>
            <!-- <td align="center"><a href="projects_photo.php?id=<?php echo $record['id']; ?>" class="btn btn-xs btn-info">Photo</i></a></td> -->
            <td align="center">
              <div class="d-flex">
                <a href="projects_edit.php?id=<?php echo $record['id']; ?>" class="btn btn-xs btn-primary">Edit</i></a>&nbsp;
                <a href="projects.php?delete=<?php echo $record['id']; ?>" onclick="javascript:confirm('Are you sure you want to delete this project?');" class="btn btn-xs btn-danger">Delete</i></a>
              </div>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</main>

<?php

include( 'includes/footer.php' );

?>