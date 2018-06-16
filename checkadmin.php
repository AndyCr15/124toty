<?php

if(!isset($_SESSION['userData'])){

            ?>
    <script type="text/javascript">
        location.href = 'login.php';

    </script>
    <?php

        } else if($_SESSION['userData']['admin']!=1){
        ?>
        <script type="text/javascript">
            location.href = 'index.php';

        </script>
        <?php
    }
    
    ?>
