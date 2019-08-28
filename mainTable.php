<noscript> Javascript is not enabled. Please, enable it! </noscript>
<LINK href="mainStyle.css" rel=stylesheet type="text/css">
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

<div class="main">
    <table id='table' border="1" cellspacing="0" cellpadding="0" text-align:center style='margin-top:25px;'>
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
                for($row = 0;$row < 8; $row++) {
                    echo "<tr>";
                    for($column = -1;$column < 5; $column++) {
                        if($column == -1) {
                            echo "<td id='hour'>" . ($row + 9) . ":00</td>";
                        }
                        else {
                            echo "<td id='" . $row . $column . "' ";
                            if(checkBook($row . $column)) {
                                echo "class='notfree'></td>";
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
   //mostra email_user e timestamp passando mouse, toglie togliendo mouse
    $('#table tr').each(function () {
        $(this).find('td').each(function () {
            var slot = this.id;
            if (slot != "day" && slot != "hour" && slot != "debug" && $(this).hasClass("notfree")) {
                var casella = $(this);
                casella.on('mouseenter', function () {
                    $.ajax({
                        url: "serverFunctions.php",
                        data: {
                            postfunctions: 'checkBook',
                            slot: slot
                        },
                        type: "POST",
                        dataType: "text"
                    }).done(function (response) {
                        casella.html(response);
                    });
                }).on('mouseleave', function () {
                    casella.html("");
                })
            }
        });
    });

    //seleziona cliccando
    $('#table tr').each(function () {
        $(this).find('td').each(function () {
            var casella = $(this);
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
                            casella.removeClass('free');
                            casella.addClass('selected');
                        } else {
                            if (casella.hasClass('selected')) {
                                casella.removeClass('selected');
                                casella.addClass('free');
                            }
                        }
                    }
                    else {
                            alert("Sign in required");
                            document.location.href = 'SignInPage.php';
                    }
                });
            })

        });
    });
</script>