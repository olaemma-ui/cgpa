<?php
    include "includes/connect.php";
    $txt = $_GET["txt"];
    if ($txt != '') {
    $select = "SELECT * FROM ((student INNER JOIN level on student.level = level.levelID) INNER JOIN gradepoint on student.stdID = gradepoint.stdID) WHERE matric LIKE '%".$txt."%' ORDER BY matric ASC";
    }
    else {
      $select = "SELECT * FROM ((student INNER JOIN level on student.level = level.levelID) INNER JOIN gradepoint on student.stdID = gradepoint.stdID) ORDER BY matric ASC";
    }
    $query = mysqli_query($con, $select);
    $i = 0;
    while ($row = mysqli_fetch_array($query)) {
      $i++;
  ?>
  <tr>
    <td class="border-r border-t p-2"><?=$i?></td>
    <td class="border-r border-t p-2 mt"><?=$row["matric"]?></td>
    <td class="border-r border-t p-2"><?=$row["std_name"]?></td>
    <td class="border-r border-t p-2"><?=$row["cgpa"]?></td>
  </tr>
<?php }?>