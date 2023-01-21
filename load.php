<?php
  include "includes/connect.php";
  $select = "";
    if (isset($_GET["id"])) {
      $select = "SELECT * FROM student 
      INNER JOIN gradepoint on student.stdId = gradepoint.stdId 
      WHERE student.sessionId = '0987654321' AND student.level = '".$_GET['id']."' ORDER BY matric ASC;";
    }else {
      $select = "SELECT * FROM (
        (INNER JOIN gradepoint on student.stdID = gradepoint.stdID) 
        WHERE student.sessionId = '0987654321' ORDER BY matric ASC";
    }

    // echo 'select = '.$select;
    $query = mysqli_query($con, $select);
    $i = 0;
    while ($row = mysqli_fetch_array($query)) {
      $i++;
  ?>
  <tr>
    <td class="border-r border-t p-2"><?=$i?></td>
    <td class="border-r border-t p-2 mt"><?=$row["matric"]?></td>
    <td class="border-r border-t p-2"><?=$row["std_name"]?></td>
    <td class="border-r border-t p-2"><?=$row["first"]?></td>
    <td class="border-r border-t p-2"><?=$row["second"]?></td>
    <td class="border-r border-t p-2"><?=$row["third"]?></td>
    <td class="border-r border-t p-2"><?=$row["fourth"]?></td>
    <td class="border-r border-t p-2"><?=$row["cgpa"]?></td>

    <td class="border-r border-t p-2 text-black flex">
      <select name="<?=$i?>" class="w-full sem" id="sem<?=$i?>">
        <option value="">Semester</option>
        <option value="1">1<sup>st</sup></option>
        <option value="2">2<sub>nd</sub></option>
        <option value="3">3<sup>rd</sup></option>
        <option value="4">4<sub>th</sub></option>
      </select>
      <button class="btn bg-blue-700 w-full text-white p-2 block score" id="<?=$row["level"]?>">
      Upload</button>

      <button class="btn bg-green-700 w-full text-white p-2 block edit-score" id="<?=$row["stdId"]?>">
      View </button>
    </td>

    <td class="border-r border-t p-2">
      <a href="#" class="btn bg-green-700 w-full p-2 block"><i class="fa fa-edit"></i></a>
    </td>
    <td class="border-r border-t p-2">
      <button class="btn bg-red-700 w-full p-2 block del-std" id="<?=$row["stdId"]?>"><i class="fa fa-trash-alt text-white"></i>
      </button>
    </td>
  </tr>
<?php
    }
    // echo $_GET["id"];
?>