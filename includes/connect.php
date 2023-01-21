<?php
  $con = mysqli_connect("localhost", "root", "", "cgpa_grading");
  if (!$con) {
    die(mysqli_error($con));
  }
?>