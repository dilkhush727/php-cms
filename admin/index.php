<?php
include( '../config/config.php' );

if(isset($_SESSION['id'])):
  header('Location: dashboard.php');
endif;

if( isset( $_POST['email'] ) )
{
  
  $query = 'SELECT *
    FROM users
    WHERE email = "'.$_POST['email'].'"
    AND password = "'.md5( $_POST['password'] ).'"
    AND active = "Yes"
    LIMIT 1';
  $result = mysqli_query( $connect, $query );
  
  if( mysqli_num_rows( $result ) )
  {
    
    $record = mysqli_fetch_assoc( $result );
    
    $_SESSION['id'] = $record['id'];
    $_SESSION['email'] = $record['email'];
    
    header( 'Location: dashboard.php' );
    die();
    
  }
  else
  {
    
    set_message( 'Incorrect email and/or password' );
    
    header( 'Location: index.php' );
    die();
    
  } 
  
}

include( 'includes/header.php' );

?>



<main class="main-auth text-center">
  <div class="form-signin">
    <form method="post">
      <div class="d-flex align-items-center justify-content-center mb-2">
        <a href="<?=base_url();?>" class="icon-back" title="Back to Home">
          <i class="fa fa-arrow-left"></i>
        </a>
      </div>
      <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

      <div class="form-floating">
        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
        <label for="email">Email</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        <label for="password">Password</label>
      </div>
      
      <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    </form>
  </div>
</main>

<?php

include( 'includes/footer.php' );

?>