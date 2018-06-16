<div>

    <?php

    $blue = 0;
    $green = 0;
    $red = 0;
    $yellow = 0;
    
    $query = "SELECT * FROM `activities`";
    $result = mysqli_query($link, $query);
    if (!$result) {
        printf("Error: %s\n", mysqli_error($link));
        exit();
    }
    while($row = mysqli_fetch_array($result)){

        $blue += $row['blue'];
        $green += $row['green'];
        $red += $row['red'];
        $yellow += $row['yellow'];

    }    
    
    $data[] = array('team' => "Blue", 'score' => $blue);
    $data[] = array('team' => "Green", 'score' => $green);
    $data[] = array('team' => "Red", 'score' => $red);
    $data[] = array('team' => "Yellow", 'score' => $yellow);

    
    // Obtain a list of columns
foreach ($data as $key => $row) {
    $score[$key]  = $row['score'];
    $team[$key] = $row['team'];
}

// Sort the data with volume descending, edition ascending
// Add $data as the last parameter, to sort by the common key
array_multisort($score, SORT_DESC, $team, SORT_ASC, $data);

    echo '<table class="leaguetable">';
    for ($x = 0; $x <= 3; $x++) {
        
        
        echo '<tr class="'.strtolower($data[$x][team]).'Background">';
        
        
        echo '<th class="leagueteams click"><strong><font size="6">';
        echo '<a href="viewpartners.php?team='.$data[$x][team].'">'.$data[$x][team].'</a></font>';
        echo '</th>';
        echo '<th class="leaguescores click"><font size="6">';
        echo '<a href="viewpartners.php?team='.$data[$x][team].'">'.$data[$x][score].'</a></font>';
        echo '</strong></th>';
        
        
        echo '</tr>';
        
        

    }
    echo '</table>';
    
    ?>

</div>
