<?php
// include "connect.php";
//   function userID () {
//     $u = array_merge(range('A', 'Z'));
//     $l = array_merge(range('a', 'z'));
//     $bool = true;
//     while ($bool) {

//       $len = 10;
//       $uid = "NCS-";
//       for ($i=0; $i < $len; $i++) {
//         $rand = mt_rand(0, 25);
//         $uid = $uid.$u[$rand];
//         $rand = mt_rand(0, 25);
//         $uid = $uid.$l[$i];
//       }

//       $file = fopen("userID.txt", "a+");
//       while (!feof($file)) {
//         $prev = fgets($file);
//         if (!$prev == $uid) {
//           $bool=!$bool;
//           fwrite($file, $uid."\n");
//         }
//       }

//       fclose($file);
//     }
//     return $uid;
//   }
//   $arr = array("ND 1", "ND 2", "HND 1", "HND 2");
//   for ($i=0; $i < count($arr); $i++) {
//     $insert = "INSERT INTO level VALUES('', '".$arr[$i]."', '".sha1(userID())."')";
//     $query = mysqli_query($con, $insert);
//     echo mysqli_error($con);
//     if ($query) {
//       echo $arr[$i];
//     }
//   }
?>