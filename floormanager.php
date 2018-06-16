<?php include 'session.php'; ?>

<!DOCTYPE html>

<html lang="en">

<head>

    <?php
        
    include 'connection.php';
    include 'functions.php';
    include 'header.php';

//    ini_set('display_errors', 1);
//    ini_set('display_startup_errors', 1);
//    error_reporting(E_ALL);

    include 'checkloggedin.php';
    
    ?>


</head>

<body>
    <div class="bg">

        <?php

        include 'navback.php';

        ?>

        <div class="container" id="accordion">

            <h1 class="click"><a href="http://124toty.androidandy.uk/floormanager.php">Floor Manager</a></h1>

            <?php
            $currentHour = currentHour();
            $pastHour = currentHour() - 1;
            
            $floorQuery = "SELECT task FROM `floormanagertasks` WHERE (`starthour` <= '".$pastHour."' AND `endhour` > '".$pastHour."')";
            $floorResult = mysqli_query($link, $floorQuery);

            //how many tasks are there?
            $num_rows = mysqli_num_rows($floorResult);

            if($num_rows > 0){
                ?>
                    <div class="panel panel-default col-12">
                        <div class="panel-heading click" id="headinglast">
                            <div style="cursor: pointer;">
                                <div class="panel-title handoverHeader">
                                    <a data-toggle="collapse" href="#last" data-target="#last" aria-expanded="false" aria-controls="last">Last Hour Checks</a>
                                </div>
                            </div>

                            <div id="last" class="collapse" aria-labelledby="headinglast" data-parent="#accordion">
                                <div class="panel-body">
                                    <?php 
                                    while($floorRow = mysqli_fetch_array($floorResult)){
                                        echo '<ul>';
                                        echo '<li><h5>'.$floorRow['task'].'</h5></li>';
                                        echo '</ul>';
                                
                                    } 
                                    ?>
                                </div>
                            </div>
                        </div>

                <?php
            }




            $floorQuery = "SELECT task FROM `floormanagertasks` WHERE (`starthour` <= '".$currentHour."' AND `endhour` > '".$currentHour."')";
            $floorResult = mysqli_query($link, $floorQuery);

            //how many tasks are there?
            $num_rows = mysqli_num_rows($floorResult);

            if($num_rows > 0){
                ?>
                <div class="panel-heading click" id="headingnow">
                    <div style="cursor: pointer;">
                        <div class="panel-title handoverHeader">
                            <a data-toggle="collapse" href="#now" data-target="#now" aria-expanded="false" aria-controls="now">Checks To Be Done This Hour</a>
                        </div>
                    </div>
                    <div id="now" class="collapse" aria-labelledby="headingnow" data-parent="#accordion">
                        <div class="panel-body">
                            <?php 
                            while($floorRow = mysqli_fetch_array($floorResult)){
                                echo '<ul>';
                                echo '<li><h5>'.$floorRow['task'].'</h5></li>';
                                echo '</ul>';
                            } 
                            ?>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
            
                <div class="panel-heading click" id="headingissues">
                    <div style="cursor: pointer;">

                        <div class="panel-title handoverHeader">
                            <a data-toggle="collapse" href="#issues" data-target="#issues" aria-expanded="true" aria-controls="issues">Issues</a>
                        </div>

                        <div id="issues" class="collapse show" aria-labelledby="headingissues" data-parent="#accordion">
                            <div class="panel-body" id="list">
                            Loading issues, please wait...
                            </div>
                        

                            <div id="error">
                                <? echo $error.$successMessage; ?>
                            </div>

                            <div>
                            
                                <form>
                                    <div class="form-group">
                                        <!--<label for="issue"><h6>What issue do you want to add?</h6></label>-->
                                        <textarea class="form-control" id="issue" name="issue" rows="3"></textarea>
                                    </div>
                                    <!--<input type="file" accept="image/*" capture>-->
                                    <button type="button" class="btn btn-primary"  onclick="addIssue(document.getElementById('issue').value)">Add</button>
                                </form>
                            
                            </div>
                        </div>
                    </div>
                </div>
            
        </div>







            <script src="https://www.gstatic.com/firebasejs/5.0.4/firebase.js"></script>
            <script>

            var database;

            // Initialize Firebase
            initFirebase();

            function initFirebase(){
                console.log('initFirebase');
                var config = {
                    apiKey: "AIzaSyDyNOFzSA59i7gl1KiZKLfgMD3vSoMUJaQ",
                    authDomain: "toty124wr.firebaseapp.com",
                    databaseURL: "https://toty124wr.firebaseio.com",
                    projectId: "toty124wr",
                    storageBucket: "",
                    messagingSenderId: "969820524769"
                };
                firebase.initializeApp(config);

                //log to check for errors
                console.log('Firebase '+ firebase);

                database = firebase.database();

                var ref = database.ref(124);
                ref.on('value', gotData, errData);
            }

            function gotData(data){
                console.log('Got Data!');

                items = data.val();

                buildList(items);

            }

            function errData(err){
                console.log('Error!');
                console.log(err);
            }

            function buildList(items){

                // clear any previous list
                var thisHTML = "";

                if(items != null){
                    console.log('Building list');
                    var keys = Object.keys(items);

                    for (var i = 0; i < keys.length; i++){
                        var k = keys[i];

                        //var key = keys[k];
                        var issue = items[k].issue;
                        var time = items[k].time;
                        var manager = items[k].manager;
                        var photo = items[k].photo;

                        var thisDatabase = firebase.database().ref(124);
                        var commentRef = thisDatabase.child(k);
                        var commentCount = 0;
                        commentRef.child("comments").on("value", function(snapshot) {
                            console.log("There are " + snapshot.numChildren() + " comments");
                            commentCount = snapshot.numChildren();
                        })
                        
                        const item = {
                            thisKey: k,
                            thisUrl: encodeURI(k),
                            thisIssue: issue,
                            thisTime: time,
                            thisManager: manager,
                            thisPhoto: photo,
                            thisCount: commentCount,
                            firstBox: ''
                            
                        }

                        if(item.thisCount > 0){
                            item.firstBox = `<div class="floorButton col-sm-4">Added by : ${item.thisManager} (Comments: ${item.thisCount})</div>`;
                        } else {
                            item.firstBox = `<div class="floorButton col-sm-4">Added by : ${item.thisManager}</div>`;
                        }


                        const markup = `
                        <div class="col-12 whiteBackground row">
                            <div class="click" style="width: 100%;">
                                <a href="floorissue.php?issue=${item.thisUrl}">
                                <p>${item.thisIssue}</p>
                                </a>
                                <div class="row">
                                    ${item.firstBox}
                                    <div class="floorButton col-sm-4">${item.thisTime}</div>
                                    <div class="floorButton col-sm-4 click"><a href="#" onclick="removeReminder('${item.thisKey}')">REMOVE</div>
                                </div>
                            </div>
                        </div>
                        `;
                            
                        thisHTML += markup;

                    }
                }
                document.getElementById("list").innerHTML = thisHTML;

            }

            function addIssue(issue) {
                //check there is a name and frequency
                if(issue == ''){ return null };
                
                var thisIssue = database.ref(124);
                var currentDate = new Date().toLocaleString();

                var data = {
                    'issue': issue,
                    'manager': '<?php echo checkPartnerFirstName($_SESSION['userData']['employee']); ?>',
                    'time': currentDate
                }

                document.getElementById('issue').value = "";
                thisIssue.push(data);

            }

            function removeReminder(key) {
                
                console.log('Removing ' + key);

                //find the reminder in the Firebase Database
                var thisUser = database.ref(124);

                //update the value
                thisUser.child(key).remove();

                //redraw the list
                buildList(items);

            }

            </script>

            <?php
                
            include 'footer.php';

            ?>

        </div>

    </div>

</body>

</html>
