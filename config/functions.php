<?php

function curl_get_contents( $url )
{
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}

function base_url( $url=null ){
  $base_url = "http://localhost/humber/php-cms/".$url;

  return $base_url;
}

function pre( $data )
{
  
  echo '<pre>';
  print_r( $data );
  echo '</pre>';
  
}

function secure()
{
  
  if( !isset( $_SESSION['id'] ) )
  {
    
    header( 'Location: /' );
    die();
    
  }
  
}

function set_message( $message )
{
  
  $_SESSION['message'] = $message;
  
}

function get_message()
{
  
  if( isset( $_SESSION['message'] ) )
  {
    
    echo '<div class="alert alert-secondary alert-dismissible fade show" role="alert">
    <i class="fa fa-exclamation-triangle"></i> '.$_SESSION['message'].'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="$(this).parent().remove();"></button>
    </div>';
    unset( $_SESSION['message'] );
    
  }
  
}

// Function to get user data by user ID
function getUserData() {
  global $connect; // Use the global connection variable

  // Prepare the query to fetch user data, including the photo
  $query = "SELECT * FROM users";
  
  // Execute the query
  $result = mysqli_query($connect, $query);

  // Check if any results were returned
  if ($result && mysqli_num_rows($result) > 0) {
      // Fetch the data as an associative array
      $user = mysqli_fetch_assoc($result);

      // Return user data
      return $user;
  } else {
      // If no user is found, return an error message
      return "User not found.";
  }
}