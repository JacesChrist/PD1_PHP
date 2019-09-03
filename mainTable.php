<LINK href="mainStyle.css" rel=stylesheet type="text/css">
<script src="jquery-3.3.1.min.js"></script>

<div class="main">
    <table id='table' cellspacing="0" cellpadding="0" text-align:center style='margin-top:25px;'>
        <tbody>
            <tr>
                <td id="debug"></td>
                <td id="day">Monday</td>
                <td id="day">Tuesday</td>
                <td id="day">Wednesday</td>
                <td id="day">Thursday</td>
                <td id="day">Friday</td>
            </tr>
            <?php
                for($row = 0;$row < 9; $row++) {
                    echo "<tr>";
                    for($column = -1;$column < 5; $column++) {
                        if($column == -1) {
                            echo "<td id='hour'>" . ($row + 8) . ":00 - ". ($row + 9) . ":00</td>";
                        }
                        else {
                            echo "<td id='" . $row . $column . "' ";
                            $email = checkTable($row . $column);
                            if($email != "free") {
                                if(isset($_SESSION['email']) && ($email == $_SESSION['email'])) {
                                    echo "class='booked'></td>";
                                }
                                else {
                                    echo "class='notfree'></td>";
                                }
                            }
                            else {
                                echo "class='free'></td>";
                            }
                        }
                    }
                }
            ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
    //mostra email_user e timestamp passando sopra caselle notfree
    $('.notfree').mouseover(function () {
        var slot = this.id;
        $.ajax({
            url: "serverFunctions.php",
            data: {
                postfunctions: 'checkBook',
                slot: slot
            },
            async: false,
            type: "POST",
            dataType: "text"
        }).done(function (response) {
            $('#' + slot).html(response);
        });
    }).mouseleave(function () {
        var slot = this.id;
        $('#' + slot).html("");
    });
</script>

<script type="text/javascript">
    //seleziona casella cliccando se loggato
    $('.free').each(function () {
        var casella = $(this);
        var slot = this.id;
        if (slot != "day" && slot != "hour" && slot != "debug" && casella.hasClass("free")) {
            casella.click(function () {
                $.ajax({
                    url: "serverFunctions.php",
                    data: {
                        postfunctions: "user_session"
                    },
                    type: "POST"
                }).done(function (data) {
                    if (data != "notlogged") { //se sono loggato
                        if (casella.hasClass('free')) {
                            casella.attr('class', 'selected');
                        } else {
                            if (casella.hasClass('selected')) {
                                casella.attr('class', 'free');
                            }
                        }
                    } else {
                        if(<?php echo "'" . explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))[count(explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) - 1] . "'"; ?> == "index.php") {
                            $("#log").html("Sign in please");
                        }
                        else {
                            alert("Session timeout");
                            document.location.href = 'SignInPage.php?';
                        }
                    }
                });
            })
        }
    });
</script>