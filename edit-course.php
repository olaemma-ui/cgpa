<?php
  include "includes/connect.php";
  if (isset($_GET["id"]) && $_SERVER["REQUEST_METHOD"] == "GET") {
    $select = "SELECT * FROM LEVEL  ORDER BY id ASC";
    $query = mysqli_query($con, $select);
    $arr = array();
    $arr_key = array();
    $i = 0;
    $a = array();
    while ($row = mysqli_fetch_array($query)) {
      array_push($arr, $row["level"]);
      array_push($arr_key, $row["levelID"]);
      $a [$row["levelID"]] = $row["level"];
      $i++;
    }
    $select = "SELECT * FROM course WHERE course_id = '".$_GET["id"]."'";
    $query = mysqli_query($con, $select);
    while ($row = mysqli_fetch_array($query)) {
      ?>
      <label for="title" class="text-sm">
        Course Title
      </label>
      <input type="text" name="name[]" id="title" class="mb-3 border shadow block w-full h-8 p-5 text-md" placeholder="Course Title" value="<?=$row["course_title"]?>">

      <label for="code" class="text-sm">
        Course Code
      </label>
      <input type="text" name="uname[]" id="code" class="mb-3 border shadow block w-full h-8 p-5 text-md" placeholder="Course Code" value="<?=$row["course_code"]?>">

      <label for="unit" class="text-sm">
        Course Unit
      </label>
      <input type="number" name="number[]" id="unit" class="mb-3 border shadow block w-full h-8 p-5 text-md" placeholder="Course Unit" value="<?=$row["course_unit"]?>">
      <input type="text" name="cid" value="<?=$row["course_id"]?>" class="invisible absolute">

      <label for="lev" class="text-sm">
        Course Level
      </label>
      <select name="lev[]" id="lev" class="border shadow text-md w-full h-full p-3 border-l text-black rounded-none mb-3">
        <option class="text-xl" value="<?=$row["level"]?>"><?=$a[$row["level"]]?></option>
        <option value="<?=$arr_key[0]?>"><?=$arr[0]?></option>
        <option value="<?=$arr_key[1]?>"><?=$arr[1]?></option>
        <option value="<?=$arr_key[2]?>"><?=$arr[2]?></option>
        <option value="<?=$arr_key[3]?>"><?=$arr[3]?></option>
      </select>


      <label for="sem" class="text-sm">
        Semester
      </label>
      <select name="number[]" id="sem" class="border shadow text-md w-full h-full p-3    border-l text-black rounded-none mb-3">
        <option class="text-xl" value="<?=$row["semester"]?>"><?=$row["semester"]?></option>
        <option value="1">1<sup>st</sup> Semester</option>
        <option value="2">2<sup>nd</sup> Semester</option>
      </select>
      <?php
    }
  }
?>