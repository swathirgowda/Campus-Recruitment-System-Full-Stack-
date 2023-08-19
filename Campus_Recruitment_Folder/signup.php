<?php
    $servername = "localhost";
    $username = "root"; 
    $password = "";
    $dbname = "campus_recruitment";
    
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $myusername = $_POST['name'];
        $myusn = $_POST['usn'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        //$usermobile = "123456789";
        $usermobile = $_POST['mobile'];
        $cgpa = $_POST['cgpa'];

        $addAdminTable = "INSERT into admin(username, passw) values('$admin_usn','$admin_password');";
        $result = mysqli_query($conn, $addAdminTable);

        $addIntoStudentQuery = "INSERT into student(student_usn, student_name, student_mobile_no, student_email, student_cgpa) VALUES('$myusn','$myusername','$usermobile','$email','$cgpa')";  //query
        $result = mysqli_query($conn, $addIntoStudentQuery);

        header("location: welcome.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration Form</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="main">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content" >
                    <form action="signup.php" method="POST" id="signup-form" class="signup-form">
                        <h2 class="form-title">Create account</h2>
                        <div class="form-group">
                            <input type="text" class="form-input" name="name" id="name" placeholder="Your Name"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="usn" id="usn" placeholder="Your usn"/>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-input" name="email" id="email" placeholder="Your Email"/>
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-input" name="mobile" id="mobile" placeholder="Your Mobile"/>
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-input" name="cgpa" id="cgpa" placeholder="Your CGPA"/>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="password" id="password" placeholder="Password"/>
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="re_password" id="re_password" placeholder="Repeat your password"/>
                        </div>
                        
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Sign up"/>
                        </div>
                    </form>
                    <p class="loginhere">
                        Have already an account ? <a href="login.php" class="loginhere-link">Login here</a>
                    </p>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>