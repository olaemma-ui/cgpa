<?php
  include "includes/connect.php";
  $id = $_GET["id"];
  $idt = substr($_GET["id"], 1);
  if ($id[0] == "c") {

    $del = "DELETE  FROM course WHERE course_id = '".$idt."'";
    $query = mysqli_query($con, $del);
    if ($query) {
      echo "Deleted";
    }else{
      echo "Error Occured **";
    }
  }

  if ($id[0] == "s") {
    $del = "DELETE  FROM student WHERE stdID = '".$idt."'";
    $query = mysqli_query($con, $del);
    if ($query) {
      echo "Deleted";
    }else{
      echo "Error Occured **";
    }
  }
?>