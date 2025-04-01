<?php

include( 'config//config.php' );
include( 'includes/header.php' );

$query = 'SELECT *
  FROM projects
  ORDER BY id DESC';
$result = mysqli_query( $connect, $query );

?>

<main class="my-5">
  
  <section class="container section-project">

    <div class="row">
      <div class="col-md-12 text-center">
        <h2 class="mb-5 page-title">Projects</h2>
      </div>
    </div>
    
    <div class="row">
      
      <?php while($record = mysqli_fetch_assoc($result)): ?>


        <div class="col-lg-4 mb-5">
          <div class="project-item">

            <div class="d-flex gap-2 align-items-center mb-2">
              <?php if($record['photo']): ?>
                <img src="admin/<?php echo htmlentities($record['photo']); ?>" class="bd-placeholder-img rounded-circle" width="140" height="140">
              <?php else: ?>
                <img src="assets/images/no-image.png" class="bd-placeholder-img rounded-circle" width="140" height="140">
              <?php endif; ?>

              <h2 class="fw-normal"><?php echo $record['title']; ?></h2>
            </div>

            <?php echo $record['content']; ?>
            <p class="card-content"></p>
            <p class="card-footer"><a class="btn-cta" href="#">View details &raquo;</a></p>
          </div>
        </div>

      <?php endwhile; ?>

    </div>

  </section>

</main>

<?php
  include( 'includes/footer.php' );
?>