<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Home - <?php echo $page; ?> </title>

  <link href="<?php echo base_url('resources/vendor/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css">

</head>

<body>

 <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a href="<?php echo base_url('admin'); ?>" class="navbar-brand d-flex w-35 me-auto">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsingNavbar3">
        </button>
        <div class="navbar-collapse collapse w-100" id="collapsingNavbar3">
            <ul class="navbar-nav w-100 justify-content-center">

            </ul>
            <ul class="nav navbar-nav ms-auto justify-content-end">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Profile</a>
                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarScrollingDropdown">
                        <li><a class="dropdown-item" href="<?php echo base_url('login/logout'); ?>">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav> <br>

<div class="container">
    
    <?php echo $body; ?>

</div>

<input type="hidden" id="base_url" name="base_url" value="<?php echo base_url(); ?>">
</body>

<script type="text/javascript" src="<?php echo base_url('resources/vendor/bootstrap/js/bootstrap.min.js')?>"></script>


</html>