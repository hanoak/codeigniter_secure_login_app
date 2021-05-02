<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.82.0">
    <title>Admin - login</title>

   <link href="<?php echo base_url('resources/app/css/login.css')?>" rel="stylesheet" type="text/css">

    

    <!-- Bootstrap core CSS -->
<link href="<?php echo base_url('resources/vendor/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css">

    
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin">
  <?php echo form_open('login/validate_login','id="myLoginForm"'); ?>
    <h1 class="h3 mb-3 fw-normal">Please log in</h1>

    <div class="form-floating">
      <input type="email" class="form-control" name="emailid" id="floatingInput" placeholder="name@example.com" maxlength="50" autocomplete="off" required>
      <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" name="pwd" id="floatingPassword" placeholder="Password" maxlength="30" minlength="12"autocomplete="off" data-password-autocomplete="off" required>
      <label for="floatingPassword">Password</label>
    </div>

    <?php echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>

   <?php if(isset($error)) 
          echo '<div class="alert alert-danger" role="alert">' . $error . '</div>'; 

    ?>

    <input type="hidden" name="token" value="<?php echo $token; ?>">

    <button class="w-100 btn btn-lg btn-primary" type="submit">Log in</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2021–2022</p>
  <?php echo form_close();?>
</main>


    
  </body>
</html>
