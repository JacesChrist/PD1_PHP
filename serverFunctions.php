<?php
    ob_start();
    session_start();

    $errors = array();

    function  checkBook($slot) {
        $db = dbConnect();
        $query = "SELECT * FROM booking WHERE slot='$slot'";
        $risultato = mysqli_query($db, $query);
        $aaa = mysqli_num_rows($risultato);
        mysqli_close($db);
        if($aaa == 0)
            return false;
        else 
            return true;
    }

    if(isset($_POST['postfunctions'])) {
        switch($_POST['postfunctions']){
            case 'checkBook': {
                $db = dbConnect();
                $slot = $_POST['slot'];
                //controllo che sia prenotato per evitare errori
                $query = "SELECT * FROM booking WHERE slot='$slot'";
                $risultato = mysqli_query($db, $query);
                $aaa = mysqli_num_rows($risultato);
                if($aaa != 0) {
                    $query = "SELECT * FROM booking WHERE slot='$slot'";
                    $query = mysqli_query($db, $query);
                    $query = mysqli_fetch_array($query);
                    echo $query['user_email'];
                    $query = "SELECT * FROM booking WHERE slot='$slot'";
                    $risultato = mysqli_query($db, $query);
                    $aaa = mysqli_num_rows($risultato);
                    $query = "SELECT * FROM booking WHERE slot='$slot'";
                    $query = mysqli_query($db, $query);
                    $query = mysqli_fetch_array($query);
                    echo "<br>" . $query['time'];
                }
                //echo "FREE";
                mysqli_close($db);
                return;
            }
            case 'user_session': { //da controllare/aggiornare sessione!!!
                //checkSession();
                if(isset($_SESSION['time']))
                    echo "loggedin";
                else 
                    echo "notlogged";
                break;
            }
        }
    }

    if(isset($_POST['trySignIn'])) {
        $db = dbConnect();
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password = $_POST['password'];
        //controllo email/password vuota
        if(empty($email))
            array_push($errors, "Email required");
        if(empty($password))
            array_push($errors, "Password required");
        //controllo email valida
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            array_push($errors, "Email is not valid");
        //query
        if (count($errors) == 0) {
            $password = md5($password);
            $query = "SELECT * FROM email_password WHERE user_email='$email' AND user_password='$password'";
            $risultato = mysqli_query($db, $query);
            if (mysqli_num_rows($risultato) == 1) {
              $_SESSION['email'] = $email;
              $_SESSION['time'] = time();
              setcookie("user", $email, time() + (86400 * 30), "/");
              $_SESSION['success'] = "You are now logged in";
              header('location: mainPage.php');
            }else {
                array_push($errors, "Wrong email or password");
            }
        }
        mysqli_close($db);
    }

    if(isset($_POST['trySignUp'])) {
        if (isset($_SESSION['time'])){ //se gia' loggato slogga
            session_destroy();
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 3600*24, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
            }
        }
        $db = dbConnect();
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password = $_POST['password'];
        //controllo email/password vuota
        if(empty($email))
            array_push($errors, "Email is required");
        if(empty($password))
            array_push($errors, "Password required");
        //controllo email valida
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            array_push($errors, "Email is not valid");
        //controllo mail dublicata
        mysqli_autocommit($db,false);
        mysqli_query($db, "SELECT * FROM email_password FOR UPDATE OF email_password");
        $query = "SELECT * FROM email_password WHERE user_email = '$email'";
        $risposta = mysqli_query($db,$query);
        mysqli_commit($db);
        $test = mysqli_fetch_assoc($risposta);
        if ($test)
            array_push($errors,"Email already registered");
        //se non ci sono stati errori
        if(count($errors) == 0) {
            $password = md5($password);
            mysqli_autocommit($db, false);
            mysqli_query($db, "SELECT * FROM email_password FOR UPDATE OF email_password");
			$query = "INSERT INTO email_password (user_email, user_password) VALUES ('$email', '$password')";
			if(!mysqli_query($db, $query)){
                array_push($errors,"Error Processing Request");
                mysqli_rollback($db);
		        mysqli_autocommit($db, true);
			}
			if(!mysqli_commit($db)){
				array_push($errors,"Error Processing Request");
                mysqli_rollback($db);
		        mysqli_autocommit($db, true);
			}
			$_SESSION['email'] = $email;
			$_SESSION['time'] = time();
			setcookie("user", $email, time() + 120, "/");
			$_SESSION['success'] = "Logged in";
            mysqli_autocommit($db, true);
            header('location: mainPage.php');
        }
        mysqli_close($db);
    }

    if(isset($_POST['SignOut'])) {
        session_destroy();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 3600*24, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
        }
        header('location: index.php');
        return;
    }

    function dbConnect() {
        $connection = mysqli_connect("localhost","root","");
        if(mysqli_connect_error())
            echo "Connection db failed";  
        if(!mysqli_select_db($connection,"pd1_php_db"))
            echo "Selection db failed";  
        return $connection;
    }

    function checkHttps(){
        if (!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] == 'off') {
            header("location: https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
            exit();
        }
    }

    function checkSession() {
        $t=time(); 
        $diff=0; 
        $new=false;
        if (isset($_SESSION['time'])){
            $t0=$_SESSION['time']; 
            $diff=($t-$t0); // inactivity
        } else {
            $new=true;
        }
        if ($new || ($diff > 20)) { // new or with inactivity period > 2min (mettere 120)
            $_SESSION=array();
            // If it's desired to kill the session, also delete the session cookie.
            // Note: This will destroy the session, and not just the session data!
            if (ini_get("session.use_cookies")) { // PHP using cookies to handle session
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 3600*24, $params["path"],
                $params["domain"], $params["secure"], $params["httponly"]);
            }
            session_destroy(); // destroy session
            // redirect client to login page
            //header('HTTP/1.1 307 temporary redirect');
            array_push($errors,"Timeout, please sign in again");
            array_push($errors,"Signed out for timeout");
            header('Location: index.php');
            exit; // IMPORTANT to avoid further output from the script
        } else {
            $_SESSION['time']=time(); /* update time */
            //echo '<html><body>Tempo ultimo accesso aggiornato: ' .$_SESSION['time'].'</body></html>';
        }       
    }

    function checkCookie(){
        setcookie("test_cookie", "test", time() + 3600, '/');
        if(count($_COOKIE) == 0){
            echo "Enable cookies to navigate this site";
            exit();
        }
    }

?>