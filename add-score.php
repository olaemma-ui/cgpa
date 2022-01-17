<?php
  include "includes/connect.php";
  $course = array();
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
      include "includes/validate.php";
      if (empty($number_err)) {
        $sem = $_GET["stdId"][strlen($_GET["stdId"])-1];
        $std = substr($_GET["stdId"], 0, 40);
        $level = substr($_GET["stdId"], 40, 40 );
        $course_unit = array();

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
              $course_unit[$i] = $row["course_unit"];
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

              $select = "SELECT * FROM gradepoint WHERE stdId = '".$std."'";
              $row = mysqli_fetch_array(mysqli_query($con, $select));
              $point = 0;
              $gp = 0;
              $unit = 0;
              for ($i=0; $i < count($number); $i++) {
                if ($number[$i] < 40)
                  $point = 1.0 * $course_unit[$i];
                elseif ($number[$i] < 45)
                  $point = 2.0 * $course_unit[$i];
                elseif ($number[$i] < 50)
                  $point = 2.25 * $course_unit[$i];
                elseif ($number[$i] < 55)
                  $point = 2.5 * $course_unit[$i];
                elseif ($number[$i] < 60)
                  $point = 2.75 * $course_unit[$i];
                elseif ($number[$i] < 65)
                  $point = 3.0 * $course_unit[$i];
                elseif ($number[$i] < 70)
                  $point = 3.25 * $course_unit[$i];
                elseif ($number[$i] < 75)
                  $point = 3.5 * $course_unit[$i];
                elseif ($number[$i] < 80)
                  $point = 3.75 * $course_unit[$i];
                elseif ($number[$i] < 100)
                  $point = 4.0 * $course_unit[$i];

                $gp += $point;
                $unit += $course_unit[$i];
              }
              if ($row["first"] == '0') {
                $GPA = round($gp / $unit, 2);

                $update = "UPDATE gradepoint SET first = '".$GPA."', cgpa = '".$GPA."' WHERE stdId = '".$std."'";

                $query = mysqli_query($con, $update);
                if ($query) {
                  echo "Score Added <i class='fa fa-graduation-cap'></i>";
                }
              }
              else if ($row["second"] == '0') {
                $GPA = round($gp / $unit, 2);
                $gp = $GPA;
                $GPA = round($GPA+$row["first"]/2, 2);

                $update = "UPDATE gradepoint SET second = '".$gp."', cgpa = '".$GPA."' WHERE stdId = '".$std."'";

                $query = mysqli_query($con, $update);
                if ($query) {
                  echo "Score Added <i class='fa fa-graduation-cap'></i>";
                }
              }

              else if ($row["third"] == '0') {
                $GPA = round($gp / $unit, 2);
                $gp = $GPA;
                $GPA = round(($GPA+$row["first"]+$row["second"]) / 3, 2);

                $update = "UPDATE gradepoint SET third = '".$gp."', cgpa = '".$GPA."' WHERE stdId = '".$std."'";

                $query = mysqli_query($con, $update);
                if ($query) {
                  echo "Score Added <i class='fa fa-graduation-cap'></i>";
                }
              }
              else if ($row["fourth"] == '0') {
                $GPA = round($gp / $unit, 2);
                $gp = $GPA;
                $GPA = round(($GPA+$row["first"]+$row["second"]+$row["third"]) / 4, 2);

                $update = "UPDATE gradepoint SET fourth = '".$gp."', cgpa = '".$GPA."' WHERE stdId = '".$std."'";

                $query = mysqli_query($con, $update);
                if ($query) {
                  echo "Score Added <i class='fa fa-graduation-cap'></i>";
                }
              }

            }
          }

        }else echo "Score already Added <i class='text-yellow-300 fa fa-exclamation-triangle'></i>!!";

      }else echo "Invalid or Incomplete details **";
  }

?>