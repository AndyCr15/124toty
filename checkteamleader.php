<?php

if(!isset($_SESSION['userData'])){
// not logged in
            ?>
    <script type="text/javascript">
        location.href = 'login.php';

    </script>
    <?php

    } else if ($_SESSION['userData']['level'] > 9 && $_SESSION['userData']['canrotationcheck'] == 0) {
        // not a team leader
    ?>
    <script type="text/javascript">
        location.href = 'index.php';

    </script>
    <?php
    }
    
    ?>
