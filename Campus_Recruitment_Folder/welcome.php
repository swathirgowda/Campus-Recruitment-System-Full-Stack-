<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = ""; 
    $dbname = "campus_recruitment";
    
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Apply for Jobs</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<style>
    body { 
        /*background-image: url('meeting.jpg');
        <div style="background-image: url('meeting.jpg');"></div>*/
        
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
    }
    
    .panel-default {
    opacity: 0.9;
    margin-top:30px;
    }
    .form-group.last { margin-bottom:0px; }</style>
    </head>
    
    <!------ Include the above in your HEAD tag ---------->
    <body>


    <?php

    //if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(!isset($_SESSION['usn']))
        {
            echo 'Sorry...Please Login Again to Continue.';
            header("location: login.php");
        }
        $usn = $_SESSION['usn'];
        //$usn = "PES12017";

        echo "
            <div class='row'>
                <div class='jumbotron text-center col-sm-9'>
                    <h1>List Of Companies You're Eligible For</h1>
                </div>
                <div class = 'bg-dark text-white text-center col-sm-3' style='margin-bottom:30px;' >
                ";
                
                $infoQuery = "SELECT student_name, student_email from student where student_usn='$usn';";
                $infoRes = mysqli_query($conn, $infoQuery);
                
                $row = mysqli_fetch_assoc($infoRes);
                $name = $row['student_name'];
                $email = $row['student_email'];

                echo '<div style="margin-top:30px;">';
                    echo '<h6>'.$name.'</h6>';
                    echo '<h6>'.$usn.'</h6>';
                    echo '<h6>'.$email.'</h6>';
                    echo 
                    "
                    <a href = 'logout.php'><button type='button' class='btn btn-danger btn-lg'>
                    Logout
                    </button></a>";
                echo '</div>';
                echo "</div>
            </div>
            <div class='container-fluid' id='main'>";
        
        $gpaQuery = "SELECT student_cgpa from student where student_usn='$usn';";
        $gpaRes = mysqli_query($conn, $gpaQuery);

        $row = mysqli_fetch_assoc($gpaRes);
        $gpa = $row['student_cgpa'];

        $searchQuery = "SELECT * from company WHERE cutoff  BETWEEN 0 and '$gpa';";
        $result = mysqli_query($conn, $searchQuery);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $orders = [];
        while($row = mysqli_fetch_assoc($result)) {
            if (!in_array($row["company_job_id"], array_keys($orders)))
            {
                $orders[$row["company_job_id"]] = [ $row["company_name"], $row['company_website'], $row["company_phone_no"], $row["company_city"], $row["company_description"], $row["job_role"], $row["salary_package"]];
            }
        }
        
        echo '<table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th class="text-center">Company Name</th>
                <th class="text-center">Website</th>
                <th class="text-center">Contact Info</th>
                <th class="text-center">City</th>
                <th class="text-center">Description</th>
                <th class="text-center">Job Role</th>
                <th class="text-center">Pay Scale</th>
                <th class="text-center">Status</th>
            </tr>
        </thead>
        <tbody>';
        
        foreach($orders as $k=>$v)
        {
            $applicationQuery = "SELECT * FROM application WHERE usn='$usn' and job_id='$k';";
            
            $result = mysqli_query($conn, $applicationQuery);
            $row = mysqli_fetch_assoc($result);

            //status 1 => Accepted
            //status 0 => Applied, No Update
            //status -1 => declined
            if(mysqli_num_rows($result) == 0){
                $class = "info";
            }else if( $row['status'] == 0){
                $class = "active";
            }else if($row['status'] == 1){
                $class ="success";
            }else if($row['status'] == -1){
                $class = "danger";
            }
            
            $classI = "table-".$class;
            echo '<tr class="'.$classI.'">';
            
            //echo '<td class="text-center">'.$k."</td>";
            echo '<td class="text-center">'.$v[0]."</td>";
            echo '<td class="text-center"><a href=https://'.$v[1].' target="_blank">'.$v[1]."</a></td>";
            echo '<td class="text-center">'.$v[2]."</td>";
            echo '<td class="text-center">'.$v[3]."</td>";
            echo '<td class="text-center">'.$v[4]."</td>";
            echo '<td class="text-center">'.$v[5]."</td>";
            echo '<td class="text-center">'.$v[6]."</td>";
            if(mysqli_num_rows($result) == 0){
                //student can apply for this job
            
                echo 
                "
                <td class='text-center'>
                <form>
                <button name='clicked' id='{$k}' onclick='approveuser($k,\"$usn\")' type='submit' type='button' class='btn btn-primary btn-lg btn-block'>
                Apply for this Job
                </form>
                </button</td>";
            }else if($row['status'] == -1){
                echo '<td class="text-center text-danger font-weight-bold">Application Declined</td>';
            }else if($row['status'] == 0){
                echo '<td class="text-center text-muted font-weight-bold">Under Processing</td>';
            }else if($row['status'] == 1){
                echo '<td class="text-center text-success font-weight-bold">Application Accepted</td>';
            }
            echo "<tr/>";
           }
        }
        else {
        echo '<div class="jumbotron text-center"><h2>Sorryyy<h2></div>';
    }

    echo "</tbody></table><br>";
    ?>
    <script>

        $.ajaxSetup({
            async: true,
            cache: false
        });
        
        (function worker() {
            $.ajax({
                url: 'refresh.php', 
                success: function(data) {
                    $('#main').html(data);
                },
                complete: function() {
                    // Schedule the next request when the current one's complete
                    setTimeout(worker, 5000);
                }
            });
        })();
        function approveuser(jobId,usn){

        console.log(usn);

            $.ajax({
                url: "update.php",
                type:"post",
                data:{ val : jobId,val1: usn},


                success: function(result){
                    alert("Application Submited");
                }
            });
        }

    </script>
</body>
</html>