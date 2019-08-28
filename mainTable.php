<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript"> </script>

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
            if (slot != "day" && slot != "hour" && slot != "debug") {
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
                        //if(response != "FREE") //NON FUNGE QUESTO CONTROLLO
                        casella.html(response);
                        /*if(response != "FREE"){ //TODO: non cambia classe se qualcuno prenota mentre guardo
                            casella.removeClass('notfree');
                            casella.addClass('free');
                        }
                        else {
                            casella.removeClass('free');
                            casella.addClass('notfree');
                        }*/
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
                });
            })

        });
    });
</script>