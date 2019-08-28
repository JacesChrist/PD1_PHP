<?php
    include('serverFunctions.php');
    checkCookie();
    checkHttps();
?>

<noscript> Javascript is not enabled. Please, enable it! </noscript>
<LINK href="mainStyle.css" rel=stylesheet type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"> </script>

<TITLE>SaveMyHealth SignUp</TITLE>

<head>
    <h1 class="mainTitle">
        SaveMyHealth - SignUp
    </h1>
</head>

<body>

    <?php include('sidebar.php') ?>
    <div class='main'>
        <form name="SignIn" method="post" onsubmit="return checkPassword()">
            <div>
                <label>Email: </label>
                <input type="email" class="input" name="email" placeholder="Insert email" required />
            </div>
            <div>
                <label>New password: </label>
                <input id="password" class="input" type="password" name="password" placeholder="Insert new password" required />
            </div>
            <div id="strength">
                <br>
            </div>
            <div>
                <label>New password again: </label>
                <input id="passwordAgain" class="input" type="password" name="passwordAgain" placeholder="Repete password" required />
            </div>
            <div>
                <button type="submit" class='button' name="trySignUp">SignUp</button>
            </div>
        </form>
        <div class="showErrorLog" id="log">
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

<script type="text/javascript">
    //check 2 password match
    function checkPassword() {
        if ($("#password").val() != $("#passwordAgain").val()) {
            $("#log").html("Passwords must match");
            return false;
        }
        return true;
    }
    //show strength
    $("#password").on('change keyup paste mouseup', function () {
        var password = $("#password").val();
        if (password.length < 3) {
            //weak
            $("#strength").html("weak");
            $("#strength").removeClass('strong');
            $("#strength").removeClass('medium');
            $("#strength").addClass('weak');
        } else {
            var special_chars = password.replace(/[A-Za-z0-9]/g, '');
            var numbers = password.replace(/[^0-9]/g, '');
            if (special_chars.length >= 2 && numbers.length >= 1) {
                //strong
                $("#strength").html("strong");
                $("#strength").removeClass('weak');
                $("#strength").removeClass('medium');
                $("#strength").addClass('strong');
            } else {
                //medium
                $("#strength").html("medium");
                $("#strength").removeClass('weak');
                $("#strength").removeClass('strong');
                $("#strength").addClass('medium');
            }
        }
    });
</script>