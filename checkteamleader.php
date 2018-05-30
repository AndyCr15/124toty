<?php

if(!isset($_SESSION['userData'])){

            ?>
    <script type="text/javascript">
        location.href = 'login.php';

    </script>
    <?php

    } else if ($_SESSION['userData']['level'] > 9 && $_SESSION['userData']['canrotationcheck'] == 0) {
    ?>
    <script type="text/javascript">
        location.href = 'index.php';

    </script>
    <?php
    }
    
    ?>
