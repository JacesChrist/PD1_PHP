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
    //mostra email_user e timestamp passando mouse
    $('#table tr').each(function () {
        $(this).find('td').each(function () {
            var casella = $(this);
            var slot = this.id;
            $(this).mouseover(function () {
                if (slot != "day" && slot != "hour" && slot != "debug") {
                    $.ajax({
                        url: "serverFunctions.php",
                        data: {
                            postfunctions: 'checkUserBook',
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
                    $.ajax({
                        url: "serverFunctions.php",
                        data: {
                            postfunctions: 'checkTimeBook',
                            slot: slot
                        },
                        type: "POST",
                        dataType: "text"
                    }).done(function (response) {
                        //if(response != "FREE")
                            casella.append('<br>' + response);
                    });
                }
            });
        })
    });
    //cancella togliendo mouse
    $('#table tr').each(function () {
        $(this).find('td').each(function () {
            var casella = $(this);
            var slot = this.id;
            $(this).mouseleave(function () {
                if (slot != "day" && slot != "hour") {
                    $(this).delay(100000).html("");
                }
            });
        })
    });
</script>