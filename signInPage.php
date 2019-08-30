<?php
    include('serverFunctions.php');
    checkCookie();
    checkHttps();

?>

<noscript> Javascript is not enabled. Please, enable it! </noscript>
<LINK href="mainStyle.css" rel=stylesheet type="text/css">
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

<TITLE>SaveMyHealth Login</TITLE>

<head>
    <h1 class="mainTitle">
        SaveMyHealth - Login
    </h1>
</head>

<body>

    <?php include('sidebar.php') ?>
    <div class='main'>
        <form method="post">
            <div class="form-group">
                <label>Email:</label>
                <input type="email" class="input" name="email" id="email" placeholder="Insert user email" required />
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" class="input" name="password" id="password" placeholder="Insert password" required />
            </div>
            <div>
                <button type="submit" class='button' name="trySignIn">Submit</button>
            </div>
        </form>
        <div class="showErrorLog">
            <?php
                        if(count($errors)!=0){
                            foreach($errors as $error) {
                                echo $error."<br />";
                            }
                        }
                    ?>
        </div>
    </div>

</body>