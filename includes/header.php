<!doctype html>
<html lang="en">
<head>
  
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
  <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png" />
  
  <title>PHP CMS</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <link href="assets/css/styles.css" type="text/css" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>

  <script src="assets/js/script.js"></script>
  
</head>
<body>
    
<header class="sticky-top">
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand ml-4" href="<?=base_url(); ?>">Dilkhush</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link <?php 
              echo (strpos($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], 'about.php') === false && 
                    strpos($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], 'projects.php') === false && 
                    strpos($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], 'contact.php') === false) ? 'active' : ''; 
              ?>" aria-current="page" href="<?=base_url(); ?>">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo (strpos($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], 'about.php') !== false) ? 'active' : ''; ?>" href="<?=base_url('about.php'); ?>">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo (strpos($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], 'projects.php') !== false) ? 'active' : ''; ?>" href="<?=base_url('projects.php'); ?>">Projects</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo (strpos($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], 'contact.php') !== false) ? 'active' : ''; ?>" href="<?=base_url('contact.php'); ?>">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=base_url('admin'); ?>"><?=isset($_SESSION['id']) ? 'Admin' : 'Login'; ?></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>