<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>My Personal Page</title>
    <meta name="description" content="Deskripsinya page ku">
    <meta name="viewport" content="width=device-width, initial-scale=0.9, user-scalable=0">
    <!--Import materialize.css-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- <link type="text/css" rel="stylesheet" href="css/materialize.css" media="screen,projection" /> -->
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <!-- <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" /> -->
    <link type="text/css" rel="stylesheet" href="css/main.css" media="screen,projection" />
    <!-- <link rel="stylesheet" href="{{ "/css/main.css" | prepend: site.baseurl }}"> -->
    <!-- <link rel="canonical" href="{{ page.url | replace:'index.html','' | prepend: site.baseurl | prepend: site.url }}"> -->
    <!-- <link href="css/materialdesignicons.min.css" media="all" rel="stylesheet" type="text/css" /> -->
    <!-- <link rel="stylesheet" href="//cdn.materialdesignicons.com/1.8.36/css/materialdesignicons.min.css"> -->

    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.nicescroll.min.js"></script>
    <script type="text/javascript" src="js/jquery.nicescroll.plus.js"></script>
    <script type="text/javascript" src="js/velocity.min.js"></script>
    <script type="text/javascript" src="js/skrollr.min.js"></script>
    <script type="text/javascript" src="js/jquery.scrolline.js"></script>
    <script type="text/javascript" src="js/modernizr.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="js/mycustom.js"></script>
</head>


<body class="cyan lighten-5">

<div class="preloader cyan container-fluid row">
    <div class="white-text text-darken-4 xpretext"><h4>My Lecturer Page</h4>
    </div>
    <div class="progress cyan lighten-2 xpreloading">
        <div class="indeterminate cyan darken-3"></div>
    </div>

</div>

<?php
    include "includes/header.php";
?>

<a class="darken-2 scrollToTop btn-floating btn-large waves-effect waves-light cyan"><i class="mdi-hardware-keyboard-arrow-up"></i></a>

<div id="page-wrap">
    <div id="main-content">
        <?php
            include "contents/home.php";
        ?>
    </div>
</div>


<div id="footer">
    <?php
        include "includes/footer.php";
    ?>
</div>


</body>

</html>
