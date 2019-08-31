<LINK href="mainStyle.css" rel=stylesheet type="text/css">
<!-- <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->
<script src="jquery-3.3.1.min.js"></script>

<div class="sidenav">
    <?php 
        switch (parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)) {
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
            case ('/s265542/distributedProgramming1/'): 
            { //index
                //SignIn
                echo "<form method='GET' action='SignInPage.php'> <button type='submit' class='sidebarButton'> Login </button> </form>";
                //SignUp
                echo "<form method='GET' action='SignUpPage.php'> <button type='submit' class='sidebarButton'> Register </button> </form>";
                break;
            }
            case ('/s265542/distributedProgramming1/SignInPage.php'):
            { //SignIn
                //Home
                echo "<form method='GET' action='mainPage.php'> <button class='sidebarButton' type='submit'> Home </button> </form>";
                //SignUp
                echo "<form method='GET' action='SignUpPage.php'> <button type='submit' class='sidebarButton'> Register </button> </form>";
                break;
            }
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
                    case ("notlogged"): {
                        alert("Sign in please");
                        document.location.href = 'SignInPage.php';
                        break;
                    }
                    case ("anySlotNotFree"): {
                        alert("Any slot is already booked");
                        document.location.href = 'mainPage.php';
                        break;
                    }
                    case ("submitSuccess"): {
                        $("#log").html("Booked successfully");
                        $('.selected').attr('class', 'booked');
                        break;
                    }
                    default: {
                        alert("Error occurred\nPlease try again");
                        document.location.href = 'mainPage.php';
                        break;
                    }
                }
            });
        } else {
            $("#log").html("Select some slot");
        }
    });
</script>

<script type="text/javascript">
    //unbook
    $('#unbook').click(function () {
        $.ajax({
            url: "serverFunctions.php",
            data: { postfunctions: "unbook" },
            type: "POST",
        }).done(function (data) {
            switch (data) {
                case ("notlogged"): {
                    alert("Sign in please");
                    document.location.href = 'SignInPage.php';
                    break;
                }
                case ("nothingBookedYet"): {
                    $("#log").html("Nothing booked yed");
                    break;
                }
                case ("unbooked"): {
                    document.location.href = 'mainPage.php'; //cambiare mostrare cambiamento
                    break;
                }
                default: {
                    alert("Error occurred\nPlease try again");
                    document.location.href = 'mainPage.php';
                    break;
                }
            }
        });
    });
</script> 
