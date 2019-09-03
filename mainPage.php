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
<script src="jquery-3.3.1.min.js"></script>

<TITLE>SaveMyHealth Home</TITLE>

<head>
    <div class="mainTitle">
        SaveMyHealth
</div>
    <div class='subTitle'>
        User <?php echo $_SESSION['email']; ?> logged
    </div>
</head>

<body>
    <?php include('sidebar.php'); ?>
    <?php include('mainTable.php'); ?>
    <?php include('errorLog.php'); ?>
</body>