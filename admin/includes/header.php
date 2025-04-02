<!doctype html>
<html lang="en">
<head>
  
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
  <link rel="shortcut icon" type="image/x-icon" href="../assets/images/favicon.png" />
  
  <title>PHP CMS | Admin</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <link href="../assets/css/styles.css" type="text/css" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>

  <script src="../assets/js/script.js"></script>
  
</head>
<body>
  
<?php echo get_message(); ?>

<body>

<header class="navbar sticky-top bg-dark flex-md-nowrap shadow" data-bs-theme="dark">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white" href="<?=base_url(); ?>">Dilkhush</a>

  <ul class="navbar-nav flex-row d-md-none">
    <li class="nav-item text-nowrap">
      <button class="nav-link px-3 text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fa fa-bars"></i>
      </button>
    </li>
  </ul>
</header>

<div class="container-fluid">
  <div class="row">

  <?php
    if(isset($_SESSION['id'])):
      include( 'aside.php' );
    endif;
  ?>