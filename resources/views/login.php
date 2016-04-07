<!DOCTYPE html>
<!--[if IE 8]>         <html class="ie8"> <![endif]-->
<!--[if IE 9]>         <html class="ie9 gt-ie8"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="gt-ie8 gt-ie9 not-ie"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Sign In - PixelAdmin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

  <!-- Open Sans font from Google CDN -->
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin" rel="stylesheet" type="text/css">

  <!-- Pixel Admin's stylesheets -->
  <link href="/assets/stylesheets/bootstrap.css" rel="stylesheet" type="text/css">
  <link href="/assets/stylesheets/pixel-admin.min.css" rel="stylesheet" type="text/css">
  <link href="/assets/stylesheets/pages.min.css" rel="stylesheet" type="text/css">
  <link href="/assets/stylesheets/rtl.min.css" rel="stylesheet" type="text/css">
  <link href="/assets/stylesheets/themes.css" rel="stylesheet" type="text/css">

  <!--[if lt IE 9]>
    <script src="assets/javascripts/ie.min.js"></script>
  <![endif]-->

</head>


<!-- 1. $BODY ======================================================================================
  
  Body

  Classes:
  * 'theme-{THEME NAME}'
  * 'right-to-left'     - Sets text direction to right-to-left
-->
<body class="theme-fresh page-signin-alt">



<!-- 2. $MAIN_NAVIGATION ===========================================================================

  Main navigation
-->
  <div class="signin-header">
    <a href="index.html" class="logo">
      <div class="demo-logo bg-primary"><img src="assets/demo/logo-big.png" alt="" style="margin-top: -4px;"></div>&nbsp;
      <strong>Pixel</strong>Admin
    </a> <!-- / .logo -->
    
  </div> <!-- / .header -->

  <h1 class="form-header">Sign in to your Account</h1>


  <!-- Form -->
  <form action="/login" id="signin-form_id" class="panel" method="POST">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"
    <div class="form-group">
      <input type="text" name="email" id="username_id" class="form-control input-lg" placeholder="Email">
    </div> <!-- / Username -->

    <div class="form-group signin-password">
      <input type="password" name="password" id="password_id" class="form-control input-lg" placeholder="Senha">
    </div> <!-- / Password -->

    <div class="form-actions">
      <input type="submit" value="Sign In" class="btn btn-primary btn-block btn-lg">
    </div> <!-- / .form-actions -->
  </form>
  <!-- / Form -->


<!-- Get jQuery from Google CDN -->
<!--[if !IE]> -->
  <script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js">'+"<"+"/script>"); </script>
<!-- <![endif]-->
<!--[if lte IE 9]>
  <script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js">'+"<"+"/script>"); </script>
<![endif]-->


<!-- Pixel Admin's javascripts -->
<script src="/assets/javascripts/bootstrap.min.js"></script>
<script src="/assets/javascripts/pixel-admin.min.js"></script>

<script type="text/javascript">
  window.PixelAdmin.start([
    function () {
      $("#signin-form_id").validate({ focusInvalid: true, errorPlacement: function () {} });
      
      // Validate username
      $("#username_id").rules("add", {
        required: true,
        minlength: 3
      });

      // Validate password
      $("#password_id").rules("add", {
        required: true,
        minlength: 6
      });
    }
  ]);
</script>

</body>
</html>
