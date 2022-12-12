<?php
  include "includes/connect.php";
  // error_reporting(0);
  $arr = array();
  $arr_key = array();
  if ($_SERVER["REQUEST_METHOD"] == "POST"){
      include "includes/validate.php";
      if (empty($number_err)) {

        $select = "SELECT * FROM LEVEL  ORDER BY id ASC";
        $query = mysqli_query($con, $select);
        while ($row = mysqli_fetch_array($query)) {
          array_push($arr, $row["level"]);
          array_push($arr_key, $row["levelID"]);
          $a [$row["levelID"]] = $row["level"];
          $i++;
        }

        $sem = $_GET["stdId"][strlen($_GET["stdId"])-1];
        $std = substr($_GET["stdId"], 0, 40);
        $level = substr($_GET["stdId"], 40, 40 );

        $sel = "SELECT * FROM std_score INNER JOIN course on std_score.courseID = course.course_id  WHERE std_score.semester = '".$sem."' AND std_score.level = '".$level."' AND std_score.stdID = '".$std."'  ORDER BY course.id DESC";
        $query = mysqli_query($con, $sel);

        if (mysqli_num_rows($query) != 0) {
          $i = 0;
          while ($row = mysqli_fetch_array($query)) {
            $update = "UPDATE std_score SET score = '".$number[$i]."' WHERE stdID = '".$std."' AND courseID = '".$row["courseID"]."'";
            $q = mysqli_query($con, $update);
            if ($q) {
              $i++;
            }
          }
          $j = mysqli_num_rows($query);
          if ($i == $j) {
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
            if ($level == $arr_key[0]) {
              echo "first".$GPA = round($gp / $unit, 2);

              $update = "UPDATE gradepoint SET first = '".$GPA."', cgpa = '".$GPA."' WHERE stdId = '".$std."'";

              $query = mysqli_query($con, $update);
              if ($query) {
                echo "Score Updated <i class='fa fa-upload'></i>";
              }
            }
            else if ($level == $arr_key[1]) {
              $GPA = round($gp / $unit, 2);
              $gp = $GPA;
              echo "second". $GPA = round($GPA+$row["first"]/2, 2);

              $update = "UPDATE gradepoint SET second = '".$gp."', cgpa = '".$GPA."' WHERE stdId = '".$std."'";

              $query = mysqli_query($con, $update);
              if ($query) {
                echo "Score Added <i class='fa fa-graduation-cap'></i>";
              }
            }
            else if ($level == $arr_key[2]) {
              $GPA = round($gp / $unit, 2);
              $gp = $GPA;
              echo "first".$GPA = round(($GPA+$row["first"]+$row["second"]) / 3, 2);

              $update = "UPDATE gradepoint SET third = '".$gp."', cgpa = '".$GPA."' WHERE stdId = '".$std."'";

              $query = mysqli_query($con, $update);
              if ($query) {
                echo "Score Added <i class='fa fa-graduation-cap'></i>";
              }
            }
            else if ($level == $arr_key[3]) {
              $GPA = round($gp / $unit, 2);
              $gp = $GPA;
              echo "first".$GPA = round(($GPA+$row["first"]+$row["second"]+$row["third"]) / 4, 2);

              $update = "UPDATE gradepoint SET fourth = '".$gp."', cgpa = '".$GPA."' WHERE stdId = '".$std."'";

              $query = mysqli_query($con, $update);
              if ($query) {
                echo "Score Added <i class='fa fa-graduation-cap'></i>";
              }
            }else{
              echo "No Score for Previous Session <i class='fa fa-exclamation-triangle'></i>";
            }
          }

        }else echo "Not Scored **";

      }else echo "Invalid or Incomplete details **";
  };

?>