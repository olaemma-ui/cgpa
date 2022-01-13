<?php
  $con = mysqli_connect("localhost", "root", "", "cgpa");
  if (!$con) {
    die(mysqli_error($con));
  }
?>