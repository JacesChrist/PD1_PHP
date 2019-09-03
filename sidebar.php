<LINK href="mainStyle.css" rel=stylesheet type="text/css">
<script src="jquery-3.3.1.min.js"></script>

<div class="sidenav">
    <?php 
		//sidebar button, switch on relative current page
        switch (explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))[count(explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) - 1]) { //prende pagina corrente
            case ('mainPage.php'): //mainPage
            { 
                //Logout
                echo "<form action='serverFunctions.php' method='POST'> <button type='submit' class='sidebarButton' name='SignOut'>Logout</button> </form>";
                //Submit
                echo "<button id='submitbutton' class='sidebarButton' name='Submit'>Submit</button>";
                //Unbook
                echo "<button id='unbook' class='sidebarButton' name='unbook'>Unbook</button>";
                break;
            }
            case ('SignInPage.php'): //SignIn
            { 
                //Home
                echo "<form method='GET' action='mainPage.php'> <button class='sidebarButton' type='submit'> Home </button> </form>";
                //SignUp
                echo "<form method='GET' action='SignUpPage.php'> <button type='submit' class='sidebarButton'> Register </button> </form>";
                break;
            }
            case ('SignUpPage.php'): //SignUp
            { 
                //Home
                echo "<form method='GET' action='mainPage.php'> <button class='sidebarButton' type='submit'> Home </button> </form>";
                //SignIn
                echo "<form method='GET' action='SignInPage.php'> <button type='submit' class='sidebarButton'> Login </button> </form>";
                break;
            }
            default: //index
            { 
                //SignIn
                echo "<form method='GET' action='SignInPage.php'> <button type='submit' class='sidebarButton'> Login </button> </form>";
                //SignUp
                echo "<form method='GET' action='SignUpPage.php'> <button type='submit' class='sidebarButton'> Register </button> </form>";
                break;
            }
        }   
    ?>
</div>

<script type="text/javascript">
    //submit     
    $('#submitbutton').click(function () {
        var elements = document.getElementsByClassName('selected');
        var selectedSlots = [];
        for (var i = 0; i < elements.length; i++) {
            selectedSlots.push(elements[i].id);
        }
        if (selectedSlots != "") {
            $.ajax({
                url: "serverFunctions.php",
                data: {
                    postfunctions: 'trySubmit',
                    selected: selectedSlots
                },
                type: "POST",
                dataType: "text"
            }).done(function (data) {
                switch (data) {
                    case ("notlogged"): { //not logged
                        alert("Timeout session");
                        document.location.href = 'SignInPage.php';
                        break;
                    }
                    case ("anySlotNotFree"): { //slot not free
                        alert("Any slot is already booked");
                        document.location.href = 'mainPage.php'; //refresh
                        break;
                    }
                    case ("submitSuccess"): { //success
                        document.location.href = 'mainPage.php?Submit successfully';
                        break;
                    }
                    default: { //error db
                        alert("Error occurred\nPlease try again");
                        document.location.href = 'mainPage.php';
                        break;
                    }
                }
            });
        } else {
            $("#log").html("Select some slot"); //no slot selected
        }
    });
</script>

<script type="text/javascript">
    //unbook
    $('#unbook').click(function () {
        $.ajax({
            url: "serverFunctions.php",
            data: {
                postfunctions: "unbook"
            },
            type: "POST",
        }).done(function (data) {
            switch (data) {
                case ("notlogged"): { //not logged
                    alert("Session timeout");
                    document.location.href = 'SignInPage.php';
                    break;
                }
                case ("nothingBookedYet"): { //no booking yet
                    $("#log").html("Nothing booked yet");
                    break;
                }
                case ("unbooked"): { //success
                    document.location.href = 'mainPage.php?Unbooked successfully'; //cambiare mostrare cambiamento
                    break;
                }
                default: { //error db
                    alert("Error occurred\nPlease try again");
                    document.location.href = 'mainPage.php';
                    break;
                }
            }
        });
    });
</script>