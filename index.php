<?php
    include('serverFunctions.php');
    checkCookie();
    checkHttps();
    if(isset($_SESSION['email'])) { //if there is a current session go to main page
        header("location: mainPage.php");
    }
?>

<noscript> Javascript is not enabled. Please, enable it! </noscript>
<LINK href="mainStyle.css" rel=stylesheet type="text/css">
<script src="jquery-3.3.1.min.js"></script>

<TITLE>SaveMyHealth</TITLE>

<head>
    <div class="mainTitle">
        SaveMyHealth
    </div>
</head>

<body>
	<!-- sidebar -->
    <?php include('sidebar.php'); ?>
	<!-- table -->
    <?php include('mainTable.php'); ?>
	<!-- log -->
    <?php include('errorLog.php'); ?>
</body>
