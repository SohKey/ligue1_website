<?php session_start(); ?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="/assets/favicon.png">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<script>
    // update title with the current route
    window.onload = () => {
        const route = window.location.pathname.split('/');        
        if(route[1] === '') document.title = 'home';
        else document.title = route[1];
    }
</script>

<body>
    <?php    
   
    include('./src/router.php');
    if (isset($_SESSION['UserInfo'])) include('./src/views/header/header_auth.php');
    else include('./src/views/header/header.php');
    ?>
</body>

</html>