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
        $name = $_POST['companyname'];
        $mail = $_POST['companymailid'];
        $website = $_POST['website'];
        $phone = $_POST['phone_no'];
        $city = $_POST['city'];
        $address = $_POST['address'];
        $desc = $_POST['address'];
        $jobrole = $_POST['jobrole'];
        $salary = $_POST['salary'];
        $cutoff = $_POST['cutoff'];

        $insertQuery = "INSERT into company( company_name, company_website, company_phone_no, company_city, company_address, company_description, salary_package, job_role, cutoff) VALUES 
        ('$name','$website','$phone', '$city', '$address', '$desc', '$salary', '$jobrole', '$cutoff');";

        $result = mysqli_query($conn, $insertQuery);
        //echo "inserted";
        //header("location: welcome.php");
    }
?>

<!DOCTYPE html>
<html>
        <head>
        
                <meta charset="utf-8">
                 <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/   bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
                </head>
                <body>
                    <form action="company.php" method="POST" style="font-size: 110%;">
                        <fieldset>
                                Company name:<br>
                                <input type="text" name="companyname" ><br><br>
                                Company mailid:<br>
                                <input type="text" name="companymailid"><br><br>
                                Company website:<br>
                                <input type="text" name="website"><br><br>
                                Phone No:<br>
                                <input type="text" name="phone_no"><br><br>
                                City:<br>
                                <input type="text" name="city"><br><br>
                                Address:<br>
                                <input type="text" name="address"><br><br>
                                Description:<br>
                                <input type="text" name="description" ><br><br>
                                Jobrole:<br>
                                <input type="text" name="jobrole"><br><br>
                                Salary:<br>
                                <input type="number" name="salary"><br><br>
                                CutOff:<br>
                                <input type="number" name="cutoff"><br><br>
                                <br>
                                <button type="submit">Submit</button>
            
                        </fieldset>
                    </form>
                </body>
</html>