<?php include 'session.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    include 'connection.php';
    include 'functions.php';

    include 'checkloggedin.php';
    include 'header.php';
    
    $error = "";

    ?>
    
    <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    
</head>

<body>
    <div class="bg">

        <?php

            include 'navback.php';

        ?>

            <div class="container">

                <h4>Deadline</h4>

                <div id="error">
                    <? echo $error; ?>
                </div>

                <form class="form-horizontal"  role="form" method="post" action="processdeadline.php">
                        
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="task">Task <sup><font color="red">*</font></sup></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="task" id="task">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label" for="comments">Comments</label>
                        <div class="col-sm-9">
                        <textarea class="form-control" id="comments" name="comments" rows="3"></textarea>
                        </div>
                    </div>
                    
                    <fieldset>
                        <div class="form-group row">
                            <label for="dtp_input2" class="col-md-3 col-form-label">Due Date  <sup><font color="red">*</font></sup></label>
                            <div class="input-group date form_date col-md-3" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                <input class="form-control" size="16" type="text" value="" name="dtp_input2" readonly>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                            <input type="hidden" id="dtp_input2" value="" /><br/>
                        </div>
                    </fieldset>

                    <div class="col-sm-9 offset-sm-3">
                        <button type="submit" class="btn btn-primary">Add Deadline</button>
                    </div>
                </form>
            </div>

            

            </div>

            <?php
            
            include ('footer.php');

        ?>
    </div>

<script type="text/javascript" src="./jquery/jquery-1.8.3.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="./bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="js/locales/bootstrap-datetimepicker.uk.js" charset="UTF-8"></script>
<script type="text/javascript">
    $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1
    });
	$('.form_date').datetimepicker({
        language:  'us',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
	$('.form_time').datetimepicker({
        language:  'us',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 1,
		minView: 0,
		maxView: 1,
		forceParse: 0
    });
</script>

<script type="text/javascript">
                    $("form").submit(function(e) {

                        var error = "";

                        if ($("#task").val() == "") {

                            error += "Please enter a task name.<br>"

                        }

                        if ($("#dtp_input2").val() == "") {

                            error += "Please enter a due date.<br>"

                        }

                        if (error != "") {

                            $("#error").html('<div class="alert alert-danger" role="alert">' + error + '</div>');

                            return false;

                        } else {

                            return true;

                        }
                    })

                </script>


</body>

</html>
