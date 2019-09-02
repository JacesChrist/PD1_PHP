<LINK href="mainStyle.css" rel=stylesheet type="text/css">
<script src="jquery-3.3.1.min.js"></script>

<div id="log">
    <?php
        if(isset($_SERVER['REQUEST_URI'])) {
            if(isset(parse_url($_SERVER['REQUEST_URI'])['query'])) {
                switch (parse_url($_SERVER['REQUEST_URI'])['query']) {
                    case ('Unbooked%20successfully'): {
                        array_push($errors,"Unbooked successfully"); //output log su reindirizzamento da unbook
                        break;
                    }
                    case ('Signed%20out'): {
                        array_push($errors,"Signed out");
                        break;
                    }
                    case ('Submit%20successfully'): {
                        array_push($errors,"Submit successfully");
                        break;
                    }
                }                    
            }
        }
        if(count($errors) != 0){
            foreach($errors as $error) {
                echo $error . "<br>";
            }
            $errors = array();
        } 
    ?>
</div>