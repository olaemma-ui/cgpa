<?php
include "includes/connect.php";
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

    $file = fopen("stdID.NCS", "a+");
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

  if (isset($_POST["matric"])) {
    for ($i=0; $i < count($_POST["matric"]); $i++) {
      if (!empty($_POST["matric"][$i])) {
        $regex = validate($_POST["matric"][$i]);
        if (!preg_match("/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}/", $regex)) {
          $matric_err[$i] = "Invalid Matric **";
        }else{
          $matric[$i] = $_POST["matric"][$i];
        }

      }
      else{
        $matric_err[$i] = "All fields are required **";
      }
    }
  }

  if (isset($_POST["lev"])) {
    if (!empty($_POST["lev"])) {
      $regex = validate($_POST["lev"]);
      if (!preg_match("/^[a-zA-Z0-9]*$/", $regex)) {
        $lev_err = "!!!!";
      }else{
        $lev = $_POST["lev"];
      }
    }
    else{
      $lev_err = "All fields are required **";
    }
  }

  if (!empty($name_err[0])) {
    echo $name_err[0];
  }
  else if (!empty($matric_err[0])) {
    echo $matric_err[0];
  }
  else if (!empty($lev_err)) {
    echo $lev_err;
  }
  else {
    $select = "SELECT * FROM student WHERE matric = '".$matric[0]."'";
    if (mysqli_num_rows(mysqli_query($con, $select)) > 0) {
      echo "Matric already EXisit **";
    }else{
      $usd = sha1(userID());
      $insert = "INSERT INTO student values('', '".$matric[0]."', '".$name[0]."', '".$lev."', '".$usd."', '0987654321')";
      $query = mysqli_query($con, $insert);
      if ($query) {
        $insert = "INSERT INTO gradepoint values('', '".$usd."', '0', '0', '0', '0', '0')";
        $query = mysqli_query($con, $insert);
        if ($query) {
          echo "Student Added";
        }else echo "";
      }
    }
  }
}
?>