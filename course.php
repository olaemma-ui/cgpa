<?php
  include "includes/header1.php";
  include "includes/connect.php";
?>
  <div class="content dash-body p-3">
    <div class="tabs w-full flex shadow p-2 fixed top-14 bg-white">
      <button class="btn-tog bg-blue-700 text-sm text-white border p-1 text-md w-20" id="view">
        View <i class="far fa-eye"></i>
      </button>

      <button class="btn-tog ml-2 text-sm text-black p-1 bg-white  text-md w-20 border" id="add">
        Add <i class="fa fa-plus"></i>
      </button>
    </div>

    <div class="tabs w-full flex shadow p-2 bg-white border md:mt-1 mt-2 sticky" id="lev-btn" style="top: 7rem;">
      <?php
        $select = "SELECT * FROM LEVEL  ORDER BY id ASC";
        $query = mysqli_query($con, $select);
        $arr = array();
        $arr_key = array();
        while ($row = mysqli_fetch_array($query)) {
          array_push($arr, $row["level"]);
          array_push($arr_key, $row["levelID"]);
        }
      ?>
        <button class="std-course bg-blue-700 text-sm text-white border p-1 text-md w-20" id="<?=$arr_key[0]?>">
        <?=$arr[0]?>
        </button>

        <button class="std-course ml-2 text-sm text-black p-1 bg-white  text-md w-20 border" id="<?=$arr_key[1]?>">
        <?=$arr[1]?>
        </button>

        <button class="std-course ml-2 text-sm text-black p-1 bg-white  text-md w-20 border" id="<?=$arr_key[2]?>">
          <?=$arr[2]?>
        </button>

        <button class="std-course ml-2 text-sm text-black p-1 bg-white  text-md w-20 border" id="<?=$arr_key[3]?>">
          <?=$arr[3]?>
        </button>
        <select name="semester" id="session" class="ml-2 text-sm text-black p-1 bg-white  text-md w-20 border">
            <option value="1">1<sup>st</sup> Semester</option>
            <option value="2">2<sup>nd</sup> Semester</option>
          </select>
      </div>
    <div class="tog mt-8">
      <div class="visible md:flex " id="table">
        <div class="overflow-y-scroll p-3 w-full">
          <div class="form-header bg-red-500 text-white text-xs mt-2" id="del-course">
          </div>
          <table class="bg-dark text-center md:w-full tbl">
            <thead class="bg-darker text-xs">
              <th class="p-2 border-r-dark w-16">SN</th>
              <th class="p-2 border-r">Code</th>
              <th class="p-2 border-r">Title</th>
              <th class="p-2 border-r">Unit</th>
              <th class="p-2 border-r">Session</th>
              <th class="p-2" colspan="2">ACTION</th>
            </thead>

            <tbody class="text-xs" id="tbl_response">
            <?php
              $select = "SELECT * FROM course WHERE level = '".$arr_key[0]."' AND semester = '1'";
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
          }?>
            </tbody>
          </table>
        </div>

        <div class="form-course md:w-3/12 lg:ml-1 mt-2 border shadow p-2">
          <?php
            if ( isset($_POST["course-btn"]) && $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cid"])){
              include 'includes/validate.php';

              if (empty($name_err) && empty( $uname_err) && empty( $number_err) && empty( $lev_err)) {
                $update = "UPDATE course SET course_title = '".$name[0]."', course_code = '".$uname[0]."', course_unit = '".$number[0]."', level = '".$lev[0]."', semester = '".$number[1]."' WHERE course_id = '".$_POST["cid"]."'";
                $query = mysqli_query($con, $update);
                if ($query) {
                  ?>
                    <div class="form-header bg-green-500 p-3 text-white text-xs" id="edit-score-alert">
                      Updated
                    </div>
                  <?php
                }
                else {
                  echo mysqli_error($con);
                }
              }else{
              ?>
              <div class="form-header bg-red-500 p-3 text-white text-xs" id="edit-score-alert">
                All Fields are Required
              </div>
              <?php
              }
            }
          ?>

          <div class="form-header bg-blue-500 text-white p-2 mt-2">
            Edit Course
          </div>
          <div class="form-content mt-3" id="edit">
            <form class="flex flex-col overflow-y-auto" method="POST" action="<?=htmlspecialchars($_SERVER["PHP_SELF"])?>" id="ed-cs">
              <div id="edit-course">
              </div>
              <div class="flex justify-end">
                <button name="course-btn" type="submit" id="ved-course" class="btn bg-green-500 p-2 text-white text-md w-20 justify-self-end" style="align-self: flex-end;" id="add_course">
                  Edit <i class="fa fa-upload"></i>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="form flex justify-center invisible relative bottom-10" style="align-items: center;" id="form">
        <div class="form-body p-2 md:w-2/4 w-full shadow-md border">
          <div class="form-header bg-red-400 text-white text-xs" id="alert-course">
          </div>
          <div class="form-header bg-blue-500 text-white p-2">
            Add Course
          </div>
          <div class="form-content mt-3">
            <form action="" class="flex flex-col" method="POST" id="course-form">
              <label for="title" class="text-sm">
                Course Title
              </label>
              <input type="text" name="name[]" id="title" class="mb-3 border shadow block w-full h-8 p-5 text-md" placeholder="Course Title">

              <label for="title" class="text-sm">
                Course Code
              </label>
              <input type="text" name="uname[]" id="title" class="mb-3 border shadow block w-full h-8 p-5 text-md" placeholder="Course Code">

              <label for="title" class="text-sm">
                Course Unit
              </label>
              <input type="number" name="number[]" id="title" class="mb-3 border shadow block w-full h-8 p-5 text-md" placeholder="Course Unit">

              <label for="title" class="text-sm">
                Course Level
              </label>
              <select name="lev[]" id="levder" class="border shadow text-xs w-full h-full p-3 border-l text-blue-400 rounded-none mb-3">
                <option class="text-xl" value="....">....</option>
                <option value="<?=$arr_key[0]?>"><?=$arr[0]?></option>
                <option value="<?=$arr_key[1]?>"><?=$arr[1]?></option>
                <option value="<?=$arr_key[2]?>"><?=$arr[2]?></option>
                <option value="<?=$arr_key[3]?>"><?=$arr[3]?></option>
              </select>

              <label for="title" class="text-sm">
                Semester
              </label>
              <select name="number[]" id="levder" class="border shadow text-xs w-full h-full p-3 border-l text-blue-400 rounded-none mb-3">
                <option class="text-xl" value="">....</option>
                <option value="1">1<sup>st</sup> Semester</option>
                <option value="2">2<sup>nd</sup> Semester</option>
              </select>

              <button name="course" class="btn bg-green-500 p-2 text-white text-sm w-20 justify-self-end" style="align-self: flex-end;" id="add_course">
                Add <i class="fa fa-plus"></i>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

<script>
  var id = "";
  var c_id = "";
  var index = 0;
  document.querySelector("#add_course").addEventListener("click", function (e) {
    e.preventDefault();
    var form = new FormData(document.getElementById("course-form"));
    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        document.querySelector("#alert-course").classList.add("p-3");
        document.querySelector("#alert-course").innerText = this.responseText;
        if (this.responseText[this.responseText.length-1] == '*') {
          document.querySelector("#alert-course").classList.replace("bg-green-500", "bg-red-400");
        }else{
          document.querySelector("#alert-course").classList.replace("bg-red-400", "bg-green-500");
        }
        table_load();
      }
    }
    xml.open("POST", "add_course.php", true);
    xml.send(form);
  })

  function edit_course() {
    for (let j = 0; j < document.querySelectorAll(".edit-course-btn").length; j++) {
      document.querySelectorAll(".edit-course-btn")[j].addEventListener("click", function (e) {
        e.preventDefault();
        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
            document.querySelector("#edit-course").innerHTML = this.responseText;
          }
        }
        xml.open("GET","edit-course.php?id="+document.querySelectorAll(".edit-course-btn")[j].id, true);
        xml.send();
      })
    }
  }

  function del_course() {
    for (let j = 0; j < document.querySelectorAll(".del-course-btn").length; j++) {
      document.querySelectorAll(".del-course-btn")[j].addEventListener("click", function (e) {
        e.preventDefault();
        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
            document.querySelector("#del-course").innerHTML = this.responseText;
            document.querySelector("#del-course").classList.add("p-3");
            if (this.responseText[this.responseText.length-1] == '*') {
              document.querySelector("#del-course").classList.replace("bg-green-500", "bg-red-500");
            }else{
              document.querySelector("#del-course").classList.replace("bg-red-500", "bg-green-500");
            }
            table_load(0);
          }
        }
        xml.open("GET","delete.php?id=c"+document.querySelectorAll(".del-course-btn")[j].id, true);
        xml.send();
      })
    }
  }
  var id = document.querySelectorAll(".std-course")[0].id;
  var session = document.querySelector("#session").value;
  onload = table_load(0);
  document.querySelector("#session").addEventListener("click", function () {
    table_load(index);
  })

  function table_load(i) {
    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function () {
      if(this.readyState == 4 && this.status == 200) {
        document.querySelector("#tbl_response").innerHTML = this.responseText;
        edit_course();
        del_course();
      }
    }
    xml.open("GET", "course-load.php?id="+document.querySelectorAll(".std-course")[i].id+document.querySelector("#session").value, true);
    xml.send();
  }


  for (let i = 0; i < document.querySelectorAll(".std-course").length; i++) {
      document.querySelectorAll(".std-course")[i].addEventListener("click", function (e) {
      var xml = new XMLHttpRequest();
      session = document.querySelector("#session").value;
      xml.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          id = document.querySelectorAll(".std-course")[i].id;
          document.querySelector("#tbl_response").innerHTML = this.responseText;
          for (let j = 0; j < document.querySelectorAll(".std-course").length; j++) {
            document.querySelectorAll(".std-course")[j].classList.replace("bg-blue-700", "bg-white");
            document.querySelectorAll(".std-course")[j].classList.replace("text-white", "text-black");
            document.querySelectorAll(".std-course")[i].classList.replace("bg-white", "bg-blue-700")
            document.querySelectorAll(".std-course")[i].classList.replace("text-black", "text-white")
            index = i;
          }
          session = document.querySelector("#session").value;
          table_load(i);
        }
      }
        xml.open("GET", "course-load.php?id="+document.querySelectorAll(".std-course")[i].id+session)
      xml.send();
    });
  }

</script>
<?php
  include "includes/footer.php";
?>