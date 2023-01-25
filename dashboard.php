<?php
  include "includes/header1.php";
  include "includes/connect.php";
?>
  <div class="content dash-body p-3">
    <div class="cards flex lg:flex-nowrap flex-wrap">
      <div class="card-1 p-2 bg-white shadow flex md:w-3/12 w-full h-40">
        <div class="circle rounded p-2 w-32 h-32 bg-blue-400 shadow-xl">
          <div class="circle rounded p-2 w-28 h-28 bg-white shadow-md text-center text-5xl pt-6">
            <?= mysqli_num_rows(mysqli_query($con, "SELECT * FROM course")); ?>
          </div>
        </div>

        <div class="txt ml-2 w-full">
          <div class="top  bg-blue-200 p-1 rounded text-center flex flex-wrap justify-center">
            <i class="far fa-newspaper text-3xl"></i> Total Courses
          </div>

        </div>
      </div>

      <div class="card-1 p-2 bg-white shadow flex md:w-3/12 w-full h-40">
        <div class="circle rounded p-2 w-32 h-32 bg-blue-400 shadow-xl">
          <div class="circle rounded p-2 w-28 h-28 bg-white shadow-md text-center text-5xl pt-6">
            <?= mysqli_num_rows(mysqli_query($con, "SELECT * FROM student")); ?>
          </div>
        </div>

        <div class="txt ml-2 w-full">
          <div class="top  bg-blue-200 p-1 rounded text-center flex flex-wrap justify-center">
            <i class="fa fa-graduation-cap text-3xl"></i> Total Student
          </div>
        </div>
      </div>
    </div>

    <div class="w-full mt-4">
      <input type="search" name="search" class="w-full shadow border p-2 focus:border-none" placeholder="Search @" id="src">
    </div>
    <div class="overflow-y-scroll visible" id="table">
      <table class="bg-dark text-center md:w-full tbl">
        <thead class="bg-darker text-xs">
          <th class="p-2 border-r-dark w-16">SN</th>
          <th class="p-2 border-r">MATRIC</th>
          <th class="p-2 border-r">Full Name</th>
          <th class="p-2 border-r">CGPA</th>
        </thead>

        <tbody class="text-xs" id="tbl_response">
          <?php
            $select = "SELECT * FROM (student INNER JOIN gradepoint on student.stdID = gradepoint.stdID) 
              ORDER BY matric ASC";
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
        </tbody>
      </table>
    </div>
  </div>
<script>
  document.querySelector("#src").addEventListener("keyup", function () {
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        document.querySelector("#tbl_response").innerHTML = this.responseText;
      }
    }
    xmlHttp.open("GET", "search.php?txt="+document.querySelector("#src").value, true)
    xmlHttp.send();
  })
</script>

<?php
  include "includes/footer.php";
?>