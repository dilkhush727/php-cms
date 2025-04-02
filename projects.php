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
            <p class="card-footer">
                <?php
                  if($record['url'] != ''){
                    echo '<a class="btn btn-warning" href="'. $record['url']. '" target="_blank">View details &raquo;</a>';
                  }else{
                    echo '<a class="btn btn-warning disabled" href="javascript:;" disabled>View details &raquo;</a>';
                  }
                ?>

                <?php if($record['youtube_link'] != ''){ ?>
                    <a class="btn btn-info" href="javascript:;" onclick="$(this).parent().parent().find('.project-embed-block').css('display', 'block');">Play Video &raquo;</a>
                  <?php }else{ ?>
                    <a class="btn btn-info disabled" href="javascript:;" disabled>Play Video &raquo;</a>
                <?php } ?>

            </p>

            <?php if($record['youtube_link'] != ''){ ?>

              <div class="project-embed-block">
                <iframe src="<?=$record['youtube_link']?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

                <i class="fa fa-times" onclick="$(this).parent().css('display', 'none');"></i>
              </div>

            <?php } ?>

          </div>
        </div>

      <?php endwhile; ?>

    </div>

  </section>

</main>

<?php
  include( 'includes/footer.php' );
?>