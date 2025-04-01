<?php

include( '../config/config.php' );

secure();

if( isset( $_GET['delete'] ) )
{
  
  $query = 'DELETE FROM contact_us
    WHERE id = '.$_GET['delete'].'
    LIMIT 1';
  mysqli_query( $connect, $query );
    
  set_message( 'Contact has been deleted' );
  
  header( 'Location: contact.php' );
  die();
  
}

include( 'includes/header.php' );

$query = 'SELECT *
  FROM contact_us
  ORDER BY id DESC';
$result = mysqli_query( $connect, $query );

?>



<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" id="main-admin">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <h1 class="h2">Manage Contacts</h1>
  </div>
  
  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th align="center">ID</th>
          <th align="left">Name</th>
          <th align="center">Message</th>
          <th align="center">Email</th>
          <th align="center">Phone</th>
          <th align="center">Date</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php while( $record = mysqli_fetch_assoc( $result ) ): ?>
          <tr>
            <td align="center"><?php echo $record['id']; ?></td>
            <td style="white-space: nowrap;"><?php echo htmlentities( $record['name'] ); ?></td>
            <td align="left">
              <?php echo htmlentities( $record['subject'] ); ?>
              <div>
                <small class="text-secondary"><?php echo $record['message']; ?></small>
              </div>
            </td>
            <td><?php echo $record['email']; ?></td>
            <td style="white-space: nowrap;"><?php echo htmlentities( $record['phone'] ); ?></td>
            <td style="white-space: nowrap;"><?php echo date('Y-m-d,  h:i A', strtotime($record['created_at']) ); ?></td>
            <td align="center">
              <div class="d-flex">
                <a href="contact.php?delete=<?php echo $record['id']; ?>" onclick="javascript:confirm('Are you sure you want to delete this contact?');" class="btn btn-xs btn-danger">Delete</i></a>
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