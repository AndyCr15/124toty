<?php

$query = "SELECT * FROM `diarynotes`";
                    $result = mysqli_query($link, $query);
                    if (!$result) {
                        printf("Error: %s\n", mysqli_error($link));
                        exit();
                    }
                        
                        $blueChecks = 0;
                        $blueFails = 0;
                        
                        $greenChecks = 0;
                        $greenFails = 0;
                        
                        $redChecks = 0;
                        $redFails = 0;
                        
                        $yellowChecks = 0;
                        $yellowFails = 0;
                          
                    while($row = mysqli_fetch_array($result)){

                        if(check_in_date_range($startDate, $endDate, (substr($row['time'], 0, 10)))){
                            
                            switch (strtolower (checkTeam($row['manager']))) {
                                case "blue":
                                    $blueChecks++;
                                    break;
                                case "green":
                                    $greenChecks++;
                                    break;
                                case "red":
                                    $redChecks++;
                                    break;
                                case "yellow":
                                    $yellowChecks++;
                                    break;
                            }

                                switch (strtolower (checkTeam($row['partner']))) {
                                    case "blue":
                                        $blueFails++;
                                        break;
                                    case "green":
                                        $greenFails++;
                                        break;
                                    case "red":
                                        $redFails++;
                                        break;
                                    case "yellow":
                                        $yellowFails++;
                                        break;
                                
                            }
                        }
                    }
                        
                    // code showing checks done and checks failed by team
                    
                    echo '<div class="col-12 col-sm-6 col-lg-4">';
                    echo '<div class="blueBackground">';
                    echo '<p>';
                    //echo '<a href="viewpartners.php?team=Blue>';
                    echo 'Diary Notes Issued : '.$blueChecks.'<br>';
                    echo 'Dairy Notes Received : '.$blueFails;
                    //echo '</a>';
                    echo '</p>';
                    echo '</div>';
                    echo '</div>';
                        
                        echo '<div class="col-12 col-sm-6 col-lg-4">';
                    echo '<div class="greenBackground">';
                    echo '<p>';
                    //echo '<a href="viewpartners.php?team=Red>';
                    echo 'Diary Notes Issued : '.$greenChecks.'<br>';
                    echo 'Dairy Notes Received : '.$greenFails.'<br>';
                    //echo '</a>';
                        echo '</p>';
                    echo '</div>';
                    echo '</div>';
                        
                    echo '<div class="col-12 col-sm-6 col-lg-4">';
                    echo '<div class="redBackground">';
                    echo '<p>';
                    //echo '<a href="viewpartners.php?team=Red>';
                    echo 'Diary Notes Issued : '.$redChecks.'<br>';
                    echo 'Dairy Notes Received : '.$redFails.'<br>';
                    //echo '</a>';
                        echo '</p>';
                    echo '</div>';
                    echo '</div>';
                        
                        echo '<div class="col-12 col-sm-6 col-lg-4">';
                    echo '<div class="yellowBackground">';
                    echo '<p>';
                    //echo '<a href="viewpartners.php?team=Red>';
                    echo 'Diary Notes Issued : '.$yellowChecks.'<br>';
                    echo 'Dairy Notes Received : '.$yellowFails.'<br>';
                    //echo '</a>';
                        echo '</p>';
                    echo '</div>';
                    echo '</div>';
                        
                    ?>
