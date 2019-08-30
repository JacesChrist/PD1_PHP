<noscript> Javascript is not enabled. Please, enable it! </noscript>
<LINK href="mainStyle.css" rel=stylesheet type="text/css">
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script type="text/javascript" src="scripts.js"></script>

<div class="sidenav">
    <?php 
        switch ($_SERVER['REQUEST_URI']) { //cambiare path cartelle in caso di cambio nomi!
            //'/^[\s\S])' regex per tutto dopo uri?
            case ('/s265542/distributedProgramming1/mainPage.php?'): 
            case ('/s265542/distributedProgramming1/mainPage.php'):
            { //mainPage
                //SignOut
                echo "<form action='serverFunctions.php' method='POST'> <button type='submit' class='sidebarButton' name='SignOut'>SignOut</button> </form>";
                //Submit
                echo "<button id='submitbutton' class='sidebarButton' name='Submit'>Submit</button>";
                //Unbook
                echo "<button id='unbook' class='sidebarButton' name='unbook'>Unbook</button>";
                break;
            }
            case ('/s265542/distributedProgramming1/index.php'): 
            case ('/s265542/distributedProgramming1/index.php?'):
            { //index
                //SignIn
                echo "<form method='GET' action='SignInPage.php'> <button type='submit' class='sidebarButton'> Login </button> </form>";
                //SignUp
                echo "<form method='GET' action='SignUpPage.php'> <button type='submit' class='sidebarButton'> Register </button> </form>";
                break;
            }
            case ('/s265542/distributedProgramming1/SignInPage.php?'):
            case ('/s265542/distributedProgramming1/SignInPage.php'):
            { //SignIn
                //Home
                echo "<form method='GET' action='mainPage.php'> <button class='sidebarButton' type='submit'> Home </button> </form>";
                //SignUp
                echo "<form method='GET' action='SignUpPage.php'> <button type='submit' class='sidebarButton'> Register </button> </form>";
                break;
            }
            case ('/s265542/distributedProgramming1/SignUpPage.php?'):
            case ('/s265542/distributedProgramming1/SignUpPage.php'): 
            { //SignUp
                //Home
                echo "<form method='GET' action='mainPage.php'> <button class='sidebarButton' type='submit'> Home </button> </form>";
                //SignIn
                echo "<form method='GET' action='SignInPage.php'> <button type='submit' class='sidebarButton'> Login </button> </form>";
                break;
            }
        }   
    ?>
</div>

<script type="text/javascript">    
    $('#submitbutton').click(function () {
        $.ajax({
            url: "serverFunctions.php",
            data: {
                postfunctions: "user_session"
            },
            type: "POST"
        }).done(function (response) {
            if (response != "notlogged") { //se sono loggato
                var selected = getSelected();
                if(selected != "") {
                    $.ajax({
                        url: "serverFunctions.php",
                        data: {
                            postfunctions: 'trySubmit',
                            selected: selected
                        },
                        type: "POST",
                        dataType: "text"
                    }).done(function (data) {
                        if(data == "submitSuccess") {
                            $('.selected').attr('class', 'booked');
                        }
                        else {
                            alert("Slot already taken");
                            document.location.href = 'mainPage.php';
                        }
                    });
                }
            } else {
                alert("Sign in please");
                document.location.href = 'SignInPage.php';
            }
        })
    });
</script>

