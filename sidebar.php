<div class="sidenav">
    <?php 
        if(isset($_SESSION['email'])) { //mostra se loggato
            echo "<form method='GET' action='mainPage.php'> <button class='sidebarButton' type='submit'> Home </button> </form>";
            echo "<form action='serverFunctions.php' method='POST'> <button type='submit' class='sidebarButton' name='SignOut'>SignOut</button> </form>";
        }
        else { //mostra se non loggato
            echo "<form method='GET' action='mainPage.php'> <button type='submit' class='sidebarButton'> Home </button> </form>";
            echo "<form method='GET' action='SignInPage.php'> <button type='submit' class='sidebarButton'> SignIn </button> </form>";
            echo "<form method='GET' action='SignUpPage.php'> <button type='submit' class='sidebarButton'> SignUp </button> </form>";
        }
    ?>
</div>