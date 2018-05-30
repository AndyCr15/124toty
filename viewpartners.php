<?php include 'session.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    
    include_once 'connection.php';
    include 'functions.php';
    include 'header.php';
    
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $team = NULL;
    if(isset($_GET["team"])){
        $team = mysqli_real_escape_string($link, $_GET["team"]);
    }
    
    $search = NULL;
    if(isset($_GET["search"]) && trim($_GET["search"]) != null){
        $search = trim($_GET["search"]);
        $search = mysqli_real_escape_string($link, $search);
    }
    
    
    
    ?>

</head>

<body>
    <div class="bg">

        <?php
        
            include ('navback.php');

        ?>

            <div class="container">

                <div class="row">
                    <?php
                    
                    if($team != NULL) {
                    
                        $query = "SELECT * FROM `partners` WHERE (`team` = '".$team."' AND `active`='1') ORDER BY `firstname`";
                        $result = mysqli_query($link, $query);
                        $num_rows = mysqli_num_rows($result);
                        
                        if (!$result) {
                            printf("Error: %s\n", mysqli_error($link));
                            exit();
                        }
                        
                        while($row = mysqli_fetch_array($result)) {

                            showUser($row);

                        }
                        
                    }
                    
                    // search for the entery in the search box from index.php
                    if($search != NULL) {
                    
                        $query = "SELECT * FROM `partners` WHERE (`firstname` LIKE '%".$search."%' OR `surname` LIKE '%".$search."%' OR `carreg` LIKE '%".str_replace(' ', '', $search)."%' OR `employee` LIKE '%".$search."%') AND `active`=1 ORDER BY `firstname`";
                        $result = mysqli_query($link, $query);
                        $rowcount=mysqli_num_rows($result);
                        $num_rows = mysqli_num_rows($result);
                        
                        if (!$result) {
                            printf("Error: %s\n", mysqli_error($link));
                            exit();
                        }
                        if($rowcount > 1) {
                            while($row = mysqli_fetch_array($result)) {
                                
                                if($row['active'] == 1){
                                    
                                    showUser($row);
                                    
                                }
                                
                            }
                            
                        } else if ($rowcount == 1) {
                            // there is only one result, so go directly to their details page
                            $row = mysqli_fetch_array($result);
                            $url = 'partnerdetails.php?employeenumber='.$row['employee'];
                    
                            ?>
                                <script type="text/javascript">
                                    
                                    location.href = "<?php echo $url; ?>"

                                </script>
                                <?php
                            
                            } else {
                            
                                // nothing matched exactly, so now we look for things similar to what was sent
                                $query = "SELECT * FROM `partners` WHERE `active` = 1";
                                $result = mysqli_query($link, $query);
                            
                                $count = 0;

                                while($row = mysqli_fetch_assoc($result)) {

                                    similar_text($search, $row['firstname'], $firstpercent);
                                    similar_text($search, $row['surname'], $surpercent);
                                    similar_text($search, $row['carreg'], $carpercent);
                                    
                                    $percent = max($firstpercent, $surpercent, ($carpercent+30));
                                    
                                    if($percent>64){
                                 
                                        showUser($row);
 
                                        // use this, so if there' only 1 result, we know and can go straight there.
                                        $count++;
                                        $emp = $row['employee'];
                                        
                                    }

                                }
                            
                                if ($count == 0){
                                    
                                    echo '<div>';
                                    echo 'No Results';
                                    echo '</div>';
                                    
                                } else if ($count == 1){
                                    
                                    $url = 'partnerdetails.php?employeenumber='.$emp;
                    
                            ?>
                                <script type="text/javascript">
                                    
                                    location.href = "<?php echo $url; ?>"

                                </script>
                                <?php
                                    
                                }

                            }
                        
                        }

                    ?>
                </div>

                <?php

                echo '<div class="row">';
                echo '<div class="col-12">';
                echo '<h4>Results Returned '.$num_rows.'</h4>';
                echo '</div>';
                echo '</div>';

                ?>

            </div>

            <?php
            
            include ('footer.php');

        ?>
    </div>
</body>

</html>
