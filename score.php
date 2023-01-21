<?php
include "includes/connect.php";
// include "includes/session.php";
  if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $session = $_GET["id"][strlen($_GET["id"])-1];
    $level = substr($_GET["id"], 0, strlen($_GET["id"])-1);

    // echo $level;
    // echo $session;

    // echo $semester;

    $select = "SELECT * FROM course WHERE level = '".$level."' AND semester = '".$session."' ORDER BY id DESC";

    $query = mysqli_query($con, $select);

    $row = mysqli_num_rows($query);
    while ($row = mysqli_fetch_array($query)) {
      ?>
       <label for="title" class="text-md font-bold">
         <?=$row["course_code"]?>
       </label>
       <input type="text" name="number[]" id="title" class="mb-3 border shadow block w-full h-8 p-4 text-md" placeholder="Score">
     <?php
    }
  }

?>