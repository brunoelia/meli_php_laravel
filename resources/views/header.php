<!DOCTYPE html>
<!--

TABLE OF CONTENTS.

Use search to find needed section.

===================================================================

|  1. $BODY                        |  Body                        |
|  2. $MAIN_NAVIGATION             |  Main navigation             |
|  3. $NAVBAR_ICON_BUTTONS         |  Navbar Icon Buttons         |
|  4. $MAIN_MENU                   |  Main menu                   |
|  5. $UPLOADS_CHART               |  Uploads chart               |
|  6. $EASY_PIE_CHARTS             |  Easy Pie charts             |
|  7. $EARNED_TODAY_STAT_PANEL     |  Earned today stat panel     |
|  8. $RETWEETS_GRAPH_STAT_PANEL   |  Retweets graph stat panel   |
|  9. $UNIQUE_VISITORS_STAT_PANEL  |  Unique visitors stat panel  |
|  10. $SUPPORT_TICKETS            |  Support tickets             |
|  11. $RECENT_ACTIVITY            |  Recent activity             |
|  12. $NEW_USERS_TABLE            |  New users table             |
|  13. $RECENT_TASKS               |  Recent tasks                |

===================================================================

-->


<!--[if IE 8]>         <html class="ie8"> <![endif]-->
<!--[if IE 9]>         <html class="ie9 gt-ie8"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="gt-ie8 gt-ie9 not-ie"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Dashboard - PixelAdmin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

  <!-- Open Sans font from Google CDN -->
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin" rel="stylesheet" type="text/css">

  <!-- Pixel Admin's stylesheets -->
  <link href="/assets/stylesheets/bootstrap.css" rel="stylesheet" type="text/css">
  <link href="/assets/stylesheets/pixel-admin.min.css" rel="stylesheet" type="text/css">
  <link href="/assets/stylesheets/widgets.min.css" rel="stylesheet" type="text/css">
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
  * 'right-to-left'      - Sets text direction to right-to-left
  * 'main-menu-right'    - Places the main menu on the right side
  * 'no-main-menu'       - Hides the main menu
  * 'main-navbar-fixed'  - Fixes the main navigation
  * 'main-menu-fixed'    - Fixes the main menu
  * 'main-menu-animated' - Animate main menu
-->
<body class="theme-fresh main-menu-animated main-navbar-fixed dont-animate-mm-content-sm animate-mm-md animate-mm-lg">

<script>var init = [];</script>

<div id="main-wrapper">


<!-- 2. $MAIN_NAVIGATION ===========================================================================

  Main navigation
-->
  <div id="main-navbar" class="navbar navbar-inverse" role="navigation">
    <!-- Main menu toggle -->
    <button type="button" id="main-menu-toggle"><i class="navbar-icon fa fa-bars icon"></i><span class="hide-menu-text">HIDE MENU</span></button>
    
    <a href="index.html" class="navbar-brand">
      MeLi - integração
    </a>
    <a href="/authorize" class="authorize"><i class="menu-icon fa fa-lock"></i>Autenticar</a>
    <div class='user'>
		  <span><?php echo Auth::user()->email; ?></span>
		  <a href="/logout">Sair</a>
		</div>
  </div> <!-- / #main-navbar -->
<!-- /2. $END_MAIN_NAVIGATION -->

  <?php include('sidebar.php') ?>