<?php
  include "includes/connect.php";
  $select = "";
  // $semester = substr($_GET["id"], strlen($_GET["id"])-2);
  
  $semester = $_GET["id"][strlen($_GET["id"])-1];

  $level = strlen(substr($_GET["id"], strlen($_GET["id"])-4,strlen($_GET["id"])-1)) == 1 ? 'ND': 'HND';


  if (isset($_GET["id"]) && $_SERVER["REQUEST_METHOD"] == "GET") {
    $select = "SELECT * FROM course WHERE semester = '".$semester."' AND level = '".$level."' AND sessionId = '0987654321'";
    $query = mysqli_query($con, $select);
    $i = 0;
    while ($row = mysqli_fetch_array($query)) {
      $i++;
  ?>
  <tr>
    <td class="border-r border-t p-2"><?=$i?></td>
    <td class="border-r border-t p-2"><?=$row["course_code"]?></td>
    <td class="border-r border-t p-2 w-3/6"><?=$row["course_title"]?></td>
    <td class="border-r border-t p-2"><?=$row["course_unit"]?></td>
    <td class="border-r border-t p-2"><?=$row["semester"]?></td>

    <td class="border-r border-t p-2 w-20">
      <button id="<?=$row["course_id"]?>" class="edit-course-btn bg-green-700 h-12 text-lg text-center w-full p-2 block"><i class="fa fa-edit"></i>
      </button>
    </td>
    <td class="border-r border-t p-2 w-20">
      <button id="<?=$row["course_id"]?>" class="del-course-btn btn tex-lg bg-red-700 w-full text-lg p-2 h-12 block">
        <i  class="fa fa-trash-alt"></i>
      </button>
      
    </td>
  </tr>
<?php
    }
  }
  else{
    header("location: course.php");
  }
?>