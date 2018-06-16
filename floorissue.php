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
    
    $issue = "";

    if(isset($_GET['issue'])){

        $issue = $_GET['issue'];
        debug_to_console($issue);

    }

    ?>

</head>

<body>
    <div class="bg">

        <?php

        include 'navback.php';

        ?>

        <div class="container">

            <h1 class="click"><a href="http://124toty.androidandy.uk/floormanager.php">Floor Manager</a></h1>

            <h6 id="issueText">Loading, please wait...</h6>

            <div id="issueComments"></div>

            <div id="error">
                <? echo $error.$successMessage; ?>
            </div>

            <div>
            
                <form>
                    <div class="form-group">
                        <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                    </div>
                    <!--<input type="file" accept="image/*" capture>-->
                    <button type="button" class="btn btn-primary"  onclick="addComment(document.getElementById('comment').value)">Add</button>
                </form>
            
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

                database = firebase.database().ref(124);

                var ref = database.child('<?php echo $issue ?>');
                ref.on('value', gotData, errData);

                //var commentRef = database.child('<?php echo $issue ?>').child('comments');
                //commentRef.on('value', gotComment, errData);
            }

            function gotData(data){
                console.log('Got Data!');

                issue = data.val();

                console.log(issue);

                showIssue(issue);
                
            }

            function errData(err){
                console.log('Error!');
                console.log(err);
            }

            function showIssue(thisIssue){

                document.getElementById("issueText").innerHTML = thisIssue.issue;

                buildList(thisIssue.comments);

            }

            function buildList(comments){

                console.log(comments);

                // clear any previous list
                var thisHTML = "";

                if(comments != null){
                    console.log('Building comments list');
                    var keys = Object.keys(comments);

                    for (var i = 0; i < keys.length; i++){
                        var k = keys[i];

                        //var key = keys[k];
                        var buildComment = comments[k].comment;
                        var time = comments[k].time;
                        var manager = comments[k].manager;
                        var photo = comments[k].photo;
                        
                        const newComment = {
                            thisKey: k,
                            thisComment: buildComment,
                            thisTime: time,
                            thisManager: manager,
                            thisPhoto: photo
                        }

                        const markup = `
                        <div class="col-12 whiteBackground row">
                            <div class="click" style="width: 100%;">
                                <p>${newComment.thisComment}</p>
                                <div class="row">
                                    <div class="floorButton col-sm-4">Added by : ${newComment.thisManager}</div>
                                    <div class="floorButton col-sm-4">${newComment.thisTime}</div>
                                    <div class="floorButton col-sm-4 click"><a href="#" onclick="removeComment('${newComment.thisKey}')">REMOVE</a></div>
                                </div>
                            </div>
                        </div>
                        `;
                            
                        thisHTML += markup;

                    }
                }
                document.getElementById("issueComments").innerHTML = thisHTML;

            }

            function addComment(comment) {

                if(comment == ''){ return null };
                
                var thisComment = database.child('<?php echo $issue ?>').child('comments');
                var currentDate = new Date().toLocaleString();

                var data = {
                    'comment': comment,
                    'manager': '<?php echo checkPartnerFirstName($_SESSION['userData']['employee']); ?>',
                    'time': currentDate
                }

                document.getElementById('comment').value = "";
                thisComment.push(data);

            }

            function removeComment(key) {
                
                console.log('Removing ' + key);

                //find the reminder in the Firebase Database
                var thisComment = database.child('<?php echo $issue ?>').child('comments');

                //update the value
                thisComment.child(key).remove();

                //redraw the list
                buildList(comments);

            }

            </script>

            <?php
                
            include 'footer.php';

            ?>

        </div>

    </div>

</body>

</html>
