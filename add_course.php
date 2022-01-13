<?php
include "includes/connect.php";
$name_err = array();
$name = array();
$uname_err = array();
$uname = array();
$number = array();
$number_err = array();
$lev = array();
$lev_err = array();
function userID () {
  $u = array_merge(range('A', 'Z'));
  $l = array_merge(range('a', 'z'));
  $bool = true;
  while ($bool) {

    $len = 10;
    $uid = "NCS-";
    for ($i=0; $i < $len; $i++) {
      $rand = mt_rand(0, 25);
      $uid = $uid.$u[$rand];
      $rand = mt_rand(0, 25);
      $uid = $uid.$l[$i];
    }

    $file = fopen("courseID.NCS", "a+");
    while (!feof($file)) {
      $prev = fgets($file);
      if (!$prev == $uid) {
        $bool=!$bool;
        fwrite($file, $uid."\n");
      }
    }

    fclose($file);
  }
  return $uid;
}

function validate ($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (isset($_POST["name"])) {
    for ($i=0; $i < count($_POST["name"]); $i++) {
      if (!empty($_POST["name"][$i])) {

        $regex = validate($_POST["name"][$i]);
        if (!preg_match("/^[a-zA-Z\s]*$/", $regex)) {
          $name_err[$i] = "No special character [A-Z a-z] **";
        }else{
          $name[$i] = $_POST["name"][$i];
        }

      }
      else{
        $name_err[$i] = "All fields are required **";
      }
    }
  }

  if (isset($_POST["uname"])) {
    for ($i=0; $i < count($_POST["uname"]); $i++) {
      if (!empty($_POST["uname"][$i])) {
        $regex = validate($_POST["uname"][$i]);
        if (!preg_match("/^[a-zA-Z 0-9]*$/", $regex)) {
          $uname_err[$i] = "No special character **";
        }else{
          $uname[$i] = strtoupper($_POST["uname"][$i]);
        }
      }
      else{
        $uname_err[$i] = "All fields are required **";
      }
    }
  }

  if (isset($_POST["number"])) {
    for ($i=0; $i < count($_POST["number"]); $i++) {
      if (!empty($_POST["number"][$i])) {
        $regex = validate($_POST["number"][$i]);
        if (!preg_match("/^[0-9]*$/", $regex)) {
          $number_err[$i] = "No special character **";
        }else{
          $number[$i] = $_POST["number"][$i];
        }
      }
      else{
        $number_err[$i] = "All fields are required **";
      }
    }
  }

  if (isset($_POST["lev"])) {
    for ($i=0; $i < count($_POST["lev"]); $i++) {
      if (!empty($_POST["lev"][$i])) {
        $regex = validate($_POST["lev"][$i]);
        if (!preg_match("/^[a-zA-Z0-9 ]*$/", $regex)) {
          $lev_err[$i] = "Fill valid details **";
        }else{
          $lev[$i] = $_POST["lev"][$i];
        }
      }
      else{
        $lev_err[$i] = "All fields are required **";
      }
    }
  }

  if (!empty($name_err[0])) {
    echo $name_err[0];
  }
  else if (!empty($uname_err[0])) {
    echo $uname_err[0];
  }
  else if (!empty($lev_err)) {
    for ($i=0; $i < count($lev_err); $i++) {
      echo $lev_err[$i];
    }
  }
  else {
    $select = "SELECT * FROM course WHERE course_code = '".$uname[0]."' && semester = '".$number[1]."'";
    if (mysqli_num_rows(mysqli_query($con, $select)) > 0) {
      echo "Course already EXisit **";
    }else{
      $insert = "INSERT INTO course values('', '".$name[0]."', '".$uname[0]."', '".sha1(UserID())."', '".$number[0]."', '".$lev[0]."', '".$number[1]."')";
      $query = mysqli_query($con, $insert);
      if ($query) {
        echo "Course Added";
      }
    }
  }
}
?>