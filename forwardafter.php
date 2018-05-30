<?php

if(isset($_GET['source'])){

    $source = $_GET['source'];

    if(strlen($source) == 8){
        // source is 8 chars long, so must be partner number
        ?>

        <script type="text/javascript">
            location.href = 'partnerdetails.php?employeenumber=<?php echo $source ?>';

        </script>

    <?php

    } else {
    ?>

    <script type="text/javascript">
        location.href = '<?php echo $source ?>.php';

    </script>

    <?php
    }

} else {
    //source is not set, so send to index (via check logged in)
    ?>

    <script type="text/javascript">
        location.href = 'login.php';

    </script>

    <?php
}

?>