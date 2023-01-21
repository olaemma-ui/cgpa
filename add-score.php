<?php
  include "includes/connect.php";
  if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $course = array();
    $sem = $_GET["stdId"][strlen($_GET["stdId"])-1];
    $std = substr($_GET["stdId"], 0, 40);
    // $level = substr($_GET["stdId"], 40, 40 );
    $level = (substr($_GET["stdId"], 40, 3) == 'HND') ? 'HND' : 'ND';
    $course_unit = array();

      include "includes/validate.php";
      if (empty($number_err)) {

        echo '<script> alert("olaemma")</script>';

        $select = "SELECT * FROM std_score WHERE semester = '".$sem."' AND level = '".$level."' AND stdID = '".$std."' ORDER BY id DESC";
        $query = mysqli_query($con, $select);
        if (mysqli_num_rows($query) == 0) {

          $select = "SELECT * FROM course WHERE semester = '".$sem."' AND level = '".$level."' ORDER BY id DESC";
          $query = mysqli_query($con, $select);
          if ($query) {
            $i = 0;
            $status = 0;
            $course = null;
            while($row = mysqli_fetch_array($query)){
              $course[$i] = $row["course_id"];
              $course_unit[$i] = $row["course_unit"];
              $i++;
            }

            $select = "SELECT * FROM gradepoint WHERE stdId = '".$std."'";
            $row = mysqli_fetch_array(mysqli_query($con, $select));
            $point = 0;
            $gp = 0;
            $unit = 0;
            $state = true;
            $status = 0;
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

            // if ($state) {
              for ($j=0; $j < count($number); $j++) {
                $insert = "INSERT INTO std_score values('', '".$std."', '".$course[$j]."', '".$number[$j]."', '".$sem."', '".$level."')";
                $query = mysqli_query($con, $insert);

                if ($query) {
                  $status++;
                }
              }
              // echo $status;
              if ($status == count($number)) { 
                $j = 0;
                if ($row["first"] == '0' && $sem == 1) {
                  $GPA = round($gp / $unit, 2);

                  $update = "UPDATE gradepoint SET first = '".$GPA."', cgpa = '".$GPA."' WHERE stdId = '".$std."'";

                  $query = mysqli_query($con, $update);
                  if ($query) {
                    $state = true;
                    $j++;
                  }
                }
                else if ($row["second"] == '0' && $row["first"] > 0 && $sem == 2) {
                  $GPA = round($gp / $unit, 2);
                  $gp = $GPA;
                  $GPA = round(($gp+$row["first"])/2, 2);

                  $update = "UPDATE gradepoint SET second = '".$gp."', cgpa = '".$GPA."' WHERE stdId = '".$std."'";

                  $query = mysqli_query($con, $update);
                  if ($query) {
                    $state = true;
                    $j++;
                  }
                }
                else if ($row["third"] == '0' && $row["second"] > 0 && $sem == 1) {
                  $GPA = round($gp / $unit, 2);
                  $gp = $GPA;
                  $GPA = round(($GPA+$row["first"]+$row["second"]) / 3, 2);

                  $update = "UPDATE gradepoint SET third = '".$gp."', cgpa = '".$GPA."' WHERE stdId = '".$std."'";

                  $query = mysqli_query($con, $update);
                  if ($query) {
                    $state = true;
                  }
                }
                else if ($row["fourth"] == '0' && $row["third"] > 0 && $sem == 2) {
                  $GPA = round($gp / $unit, 2);
                  $gp = $GPA;
                  $GPA = round(($GPA+$row["first"]+$row["second"]+$row["third"]) / 4, 2);

                  $update = "UPDATE gradepoint SET fourth = '".$gp."', cgpa = '".$GPA."' WHERE stdId = '".$std."'";

                  $query = mysqli_query($con, $update);
                  if ($query) {
                    $state = true;
                  }
                }else{
                  echo "No Score for Previous Session <i class='fa fa-exclamation-triangle'></i>";
                  $state = false;
                }
                echo "Score Added <i class='fa fa-graduation-cap'></i>";
                // echo $j;
              }
            // }
          }
        }else echo "Score already Added <i class='text-yellow-300 fa fa-exclamation-triangle'></i>!!";

      }else echo "Invalid or Incomplete details **";
  }

?>