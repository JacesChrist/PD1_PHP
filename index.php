<?php
    include('serverFunctions.php');
    checkCookie();
    checkHttps();
?>

<noscript> Javascript is not enabled. Please, enable it! </noscript>
<LINK href="mainStyle.css" rel=stylesheet type="text/css">
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>


<TITLE>SaveMyHealth</TITLE>

<head>
    <h1 class="mainTitle">
        SaveMyHealth
    </h1>
</head>

<body>

    <?php include('sidebar.php'); ?>
    <?php include('mainTable.php'); ?>
    
</body>
