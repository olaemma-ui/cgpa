<?php
  include "includes/connect.php";
  if ($_SERVER["REQUEST_METHOD"] == "GET"){
      include "includes/validate.php";
      if (empty($number_err)) {
        $sem = $_GET["stdId"][strlen($_GET["stdId"])-1];
        $std = substr($_GET["stdId"], 0, 40);
        $level = (substr($_GET["stdId"], 40, 3) == 'HND') ? 'HND' : 'ND';

        $sel = "SELECT * FROM std_score INNER JOIN course on std_score.courseID = course.course_id  WHERE std_score.semester = '".$sem."' AND std_score.level = '".$level."' AND std_score.stdID = '".$std."'  ORDER BY course.id DESC";
        $query = mysqli_query($con, $sel);

        if (mysqli_num_rows($query) != 0) {
          while ($row = mysqli_fetch_array($query)) {
            ?>
              <label for="title" class="text-md font-bold">
                <?=$row["course_code"]?>
              </label>
              <input type="text" name="number[]" value="<?=$row["score"]?>" id="title" class="mb-3 border shadow block w-full h-8 p-4 text-md" placeholder="Score">
            <?php
          }
        }else echo "Not Scored **";

      }else echo "Invalid or Incomplete details **";
  };

?>