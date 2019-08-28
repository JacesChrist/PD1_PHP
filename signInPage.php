<?php
    include('serverFunctions.php');
    checkCookie();
    checkHttps();
?>

<noscript> Javascript is not enabled. Please, enable it! </noscript>
<LINK href="mainStyle.css" rel=stylesheet type="text/css">

<TITLE>SaveMyHealth SignIn</TITLE>

<head>
    <h1 class="mainTitle">
        SaveMyHealth - SignIn
    </h1>
</head>

<body>

    <?php include('sidebar.php') ?>
    <div class='main'>
        <form method="post">
            <div class="form-group">
                <label>Email:</label>
                <input type="email" class="input" name="email" id="email" placeholder="Insert email here" required />
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" class="input" name="password" id="password" placeholder="Insert password here" required />
            </div>
            <div>
                <button type="submit" class='button' name="trySignIn">SignIn</button>
            </div>
        </form>
        <div class="showErrorLog">
            <?php
                        if(count($errors)!=0){
                            echo "ERROR:<br />";
                            foreach($errors as $error) {
                                echo $error."<br />";
                            }
                        }
                    ?>
        </div>
    </div>

</body>