<?php
    include('serverFunctions.php');
    checkCookie();
    checkHttps();
?>

<noscript> Javascript is not enabled. Please, enable it! </noscript>
<LINK href="mainStyle.css" rel=stylesheet type="text/css">
<script src="jquery-3.3.1.min.js"></script>

<TITLE>SaveMyHealth Login</TITLE>

<head>
    <div class="mainTitle">
        SaveMyHealth - Login
    </div>
</head>

<body>
	<!-- sidebar -->
    <?php include('sidebar.php') ?>
    <div class='main'>
        <form method="post">
            <div class="form-group">
                <label>Email:</label>
                <input type="email" class="input" name="email" id="email" placeholder="Insert user email here" required />
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" class="input" name="password" id="password" placeholder="Insert password here" required />
            </div>
            <div>
                <button type="submit" class='button' name="trySignIn">Submit</button>
            </div>
        </form>
    </div>
	<!-- log -->
    <?php include('errorLog.php'); ?>
</body>
