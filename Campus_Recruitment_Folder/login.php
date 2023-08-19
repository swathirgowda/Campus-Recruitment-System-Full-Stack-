<?php
    $servername = "localhost";
    $username = "root";
    $password = ""; 
    $dbname = "campus_recruitment";
    $error = "";
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    if($_SERVER["REQUEST_METHOD"] == "POST") {

        $myUserEmail = $_POST['useremail'];
        $myPassword = $_POST['password'];

        $sql = "SELECT student_usn FROM student WHERE student_email='$myUserEmail'";
        
        $result = mysqli_query($conn, $sql);
        
        if(mysqli_num_rows($result) == 0){
            $error = "No User Found. Please Signup.";
        }
        else{
            $row = mysqli_fetch_assoc($result);
            $myUserName = $row['student_usn'];

            $sql = "SELECT admin_usn FROM admin WHERE admin_usn = '$myUserName' and admin_password = '$myPassword'";
            $result = mysqli_query($conn, $sql);
            
            $count = mysqli_num_rows($result);
        
            if($count == 1) {
                session_start();
                $_SESSION['usn'] = $myUserName;
                $_SESSION['valid'] = true;
                header("location: welcome.php");     
            }else {
                $error = "Incorrect Password";
            }
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Log In Form</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<style>
    body { 
        background-image: url('meeting.jpg');
        <div style="background-image: url('meeting.jpg');"></div>
        
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
            <div style="background-image: url('meeting.jpg');"></div>
    <div class="container">
            
        <div class="row">
            <div class="col-md-4 col-md-offset-7">
                <div class="panel panel-default">
                    <div class="panel-heading" ; style="align-content: center">
                        <span class="glyphicon glyphicon-lock"></span><h2> Login</h2></div>
                    <div class="panel-body">
                        <form action = "login.php" method="POST" class="form-horizontal" role="form">
                        <div class="form-group" >
                            <label for="inputEmail3" class="col-sm-3 control-label">
                                Email</label>
                            <div class="col-sm-9">
                                <input class="form-control" name="useremail" id="loginEmail" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">
                                Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="password" id="loginPassword" placeholder="Password" required>
                            </div>
                            <?php 
                            echo '                  
                            <p style="margin-left:20px; margin-top:10px;" class="text-danger">'.$error. '</p>';
                            ?>
                        </div>
                        
                        <div class="form-group last">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-success btn-sm">
                                    Log In</button>
                                     <button type="reset" class="btn btn-default btn-sm">
                                    Reset</button>
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="panel-footer">
                        Not Registred? <a href="signup.html">Register here</a></div>
                </div>
            </div>
        </div>
        
    </div>
    </body>
    </html>