<?php
   session_start();
   unset($_SESSION['usn']);
   unset($_SESSION['valid']);
   
   echo 'Successfully Logged Out';
   header("location: login.php");

   //$_COOKIE[""]
?>