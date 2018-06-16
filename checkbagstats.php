<?php

$query = "SELECT * FROM `bagchecks`";
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

    if(check_in_date_range($startdate, $enddate, (substr($row['time'], 0, 10)))){

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

        if($row['result']=='fail'){

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
}

// code showing checks done and checks failed by team

echo '<div class="col-12 col-sm-6 col-lg-4">';
echo '<div class="blueBackground">';
//echo '<a href="viewpartners.php?team=Blue>';
echo 'Checks Done : '.$blueChecks.'<br>';
echo 'Checks Failed : '.$blueFails;
//echo '</a>';
echo '</div>';
echo '</div>';

echo '<div class="col-12 col-sm-6 col-lg-4">';
echo '<div class="greenBackground">';
//echo '<a href="viewpartners.php?team=Red>';
echo 'Checks Done : '.$greenChecks.'<br>';
echo 'Checks Failed : '.$greenFails.'<br>';
//echo '</a>';
echo '</div>';
echo '</div>';

echo '<div class="col-12 col-sm-6 col-lg-4">';
echo '<div class="redBackground">';
//echo '<a href="viewpartners.php?team=Red>';
echo 'Checks Done : '.$redChecks.'<br>';
echo 'Checks Failed : '.$redFails.'<br>';
//echo '</a>';
echo '</div>';
echo '</div>';

echo '<div class="col-12 col-sm-6 col-lg-4">';
echo '<div class="yellowBackground">';
//echo '<a href="viewpartners.php?team=Red>';
echo 'Checks Done : '.$yellowChecks.'<br>';
echo 'Checks Failed : '.$yellowFails.'<br>';
//echo '</a>';
echo '</div>';
echo '</div>';

?>
