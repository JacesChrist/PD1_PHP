<?php
    include('serverFunctions.php');
    checkCookie();
    checkHttps();
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

    <?php include('sidebar.php'); ?>
    <?php include('mainTable.php'); ?>
    <?php include('errorLog.php'); ?>
    
</body>
