<LINK href="mainStyle.css" rel=stylesheet type="text/css">
<script src="jquery-3.3.1.min.js"></script>

<div id="log">
    <?php
        if(count($errors) != 0){
            foreach($errors as $error) {
                echo $error . "<br>";
            }
            $errors = array();
        } 
    ?>
</div>