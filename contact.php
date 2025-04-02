<?php

include( 'config/config.php' );
include( 'includes/header.php' );

$form_submitted = false;  // Flag to check if the form has been submitted

if (isset($_POST['email'])) {

  if ($_POST['email'] && $_POST['message']) {

      // Insert into database
      $query = 'INSERT INTO contact_us (
          name,
          email,
          phone,
          subject,
          message
      ) VALUES (
          "' . mysqli_real_escape_string($connect, $_POST['name']) . '",
          "' . mysqli_real_escape_string($connect, $_POST['email']) . '",
          "' . mysqli_real_escape_string($connect, $_POST['phone']) . '",
          "' . mysqli_real_escape_string($connect, $_POST['subject']) . '",
          "' . mysqli_real_escape_string($connect, $_POST['message']) . '"
      )';

      mysqli_query($connect, $query);
      
      set_message('Thank you! Your query has been submitted. I will contact you soon.');
      
      $form_submitted = true; // Set the flag to true
  }

  // header('Location: projects.php');
  // die();
}

?>

<main class="my-5">

  <section class="container section-contact mb-5">

    <div class="row">
      <div class="col-md-12 text-center">
        <h2 class="mb-5 page-title">Contact</h2>
      </div>
    </div>

    <div class="row gy-4 justify-content-center">

      <div class="col-lg-4">
        <!-- Contact information -->
        <div class="row gy-4 justify-content-center">
          <div class="col-lg-12 col-md-6 col-sm-6 mt-2">
            <h3>Email</h3>
            <p><?=getUserData()['email']; ?></p>
          </div>

          <div class="col-lg-12 col-md-6 col-sm-6 mt-2">
            <h3>Phone</h3>
            <p><?=getUserData()['phone']; ?></p>
          </div>

          <div class="col-lg-12 col-md-6 col-sm-6 mt-2">
            <h3>City</h3>
            <p><?=getUserData()['city']; ?></p>
          </div>

          <div class="col-lg-12 col-md-6 col-sm-6 mt-2">
            <h3>Social Profiles</h3>
            <div class="social-links">
              <a href="<?=getUserData()['linkedin']; ?>" class="linkedin" target="_blank"><i class="fab fa-linkedin"></i></a>
              <a href="<?=getUserData()['instagram']; ?>" class="instagram" target="_blank"><i class="fab fa-instagram"></i></a>
              <a href="<?=getUserData()['facebook']; ?>" class="facebook" target="_blank"><i class="fab fa-facebook"></i></a>
              <a href="<?=getUserData()['twitter']; ?>" class="twitter" target="_blank"><i class="fab fa-twitter"></i></a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-8 d-flex align-items-center">
        <?php if ($form_submitted): ?>
          <!-- Success Message -->
          <div class="alert alert-success position-relative">
            <h4>Thank you! Your query has been submitted. I will contact you soon.</h4>
          </div>
        <?php else: ?>
          <!-- Contact Form -->
          <form method="post" role="form" class="mt-4" id="contact-form">
            <div class="row">
              <div class="col-md-6 form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
              </div>
              <div class="col-md-6 form-group mt-3 mt-md-0">
                <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" required>
              </div>
            </div>
            <div class="form-group mt-3">
              <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
            </div>
            <div class="form-group mt-3">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
            </div>
            <div class="form-group mt-3">
              <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
            </div>
            <div class="text-center form-group mt-3">
              <button type="submit" class="btn-cta">Send Message</button>
            </div>
          </form>
        <?php endif; ?>
      </div>
    </div>

  </section>

</main>

<?php
include( 'includes/footer.php' );
?>

<script>
// JavaScript to hide the form and show the success message
<?php if ($form_submitted): ?>
  document.getElementById('contact-form').style.display = 'none';
<?php endif; ?>
</script>
