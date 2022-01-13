<?php
  include "includes/connect.php";
  $course = array();
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
      include "includes/validate.php";
      if (empty($number_err)) {
        $sem = $_GET["stdId"][strlen($_GET["stdId"])-1];
        $std = substr($_GET["stdId"], 0, 40);
        $level = substr($_GET["stdId"], 40, 40 );

        $select = "SELECT * FROM std_score WHERE semester = '".$sem."' AND level = '".$level."' AND stdID = '".$std."' ORDER BY id DESC";
        $query = mysqli_query($con, $select);
        if (mysqli_num_rows($query) == 0) {

          $select = "SELECT * FROM course WHERE semester = '".$sem."' AND level = '".$level."' ORDER BY id DESC";
          $query = mysqli_query($con, $select);
          if ($query) {
            $i = 0;
            $status = 0;

            while($row = mysqli_fetch_array($query)){
              $course[$i] = $row["course_id"];
              $i++;
            }

            for ($j=0; $j < count($number); $j++) {
              $insert = "INSERT INTO std_score values('', '".$std."', '".$course[$j]."', '".$number[$j]."', '".$sem."', '".$level."')";
              $query = mysqli_query($con, $insert);

              if ($query) {
                $status++;
              }
            }

            if ($status == count($number)) {
              echo "Score Added <i class='fa fa-graduation-cap'></i>";
            }
          }

        }else echo "Score already Added <i class='text-yellow-300 fa fa-exclamation-triangle'></i>!!";

      }else echo "Invalid or Incomplete details **";
  }

?>