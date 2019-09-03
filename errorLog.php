<LINK href="mainStyle.css" rel=stylesheet type="text/css">
<script src="jquery-3.3.1.min.js"></script>

<div id='log'>
    <?php
        if(isset($_SERVER['REQUEST_URI'])) {
            if(isset(parse_url($_SERVER['REQUEST_URI'])['query'])) {
                switch (parse_url($_SERVER['REQUEST_URI'])['query']) { //on redirect by other pages show log
                    case ('Unbooked%20successfully'): {
                        array_push($errors,"Unbooked successfully"); //redirect after unbook
                        break;
                    }
                    case ('Signed%20out'): {
                        array_push($errors,"Logged out"); //redirect after logout
                        break;
                    }
                    case ('Submit%20successfully'): {
                        array_push($errors,"Submit successfully"); //redirect after submit
                        break;
                    }
                }                    
            }
        }
        if(count($errors) != 0){ //print errors/log if any
            foreach($errors as $error) {
                echo $error . "<br>";
            }
            $errors = array();
        } 
    ?>
</div>