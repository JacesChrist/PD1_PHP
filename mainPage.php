<?php
    include('serverFunctions.php');
    checkCookie();
    checkHttps();
    if(!checkSession()) {
        echo "<script type='text/javascript'>alert('Session timeout\nPlease sign in again');</script>";
        header('location: index.php');
    }
?>

<noscript> Javascript is not enabled. Please, enable it! </noscript>
<LINK href="mainStyle.css" rel=stylesheet type="text/css">

<TITLE>SaveMyHealth Home</TITLE>

<head>
    <h1 class="mainTitle">
        SaveMyHealth
</h1>
    <?php
        echo "<div class='mainTitle' style='font-size:30px'>User " . $_SESSION['email'] . "</div>";
    ?>
</head>

<body>
    <?php include('sidebar.php'); ?>
    <?php include('mainTable.php'); ?>
</body>