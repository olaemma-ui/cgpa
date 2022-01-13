<?php
  include "includes/header1.php";
  include "includes/connect.php";
?>
  <div class="content dash-body p-3">
    <div class="tabs  flex shadow border p-2 fixed top-14 bg-white">
      <button class="btn-tog bg-blue-700 text-sm text-white border p-1 text-md w-20" id="view">
        View <i class="far fa-eye"></i>
      </button>

      <button class="btn-tog ml-2 text-sm text-black p-1 bg-white  text-md w-20 border" id="add">
        Add <i class="fa fa-plus"></i>
      </button>
    </div>
    <hr class="border mt-12 mb-0">
    <div class="tog">
      <div class="visible" id="table">
        <!-- <div class="fixed"> -->
            <div class="tabs w-full flex shadow p-2 bg-white border md:mt-1 mt-2 sticky" style="top: 7rem;">
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
              <button class="std-tog bg-blue-700 text-sm text-white border p-1 text-md w-20" id="<?=$arr_key[0]?>">
              <?=$arr[0]?>
              </button>

              <button class="std-tog ml-2 text-sm text-black p-1 bg-white  text-md w-20 border" id="<?=$arr_key[1]?>">
              <?=$arr[1]?>
              </button>

              <button class="std-tog ml-2 text-sm text-black p-1 bg-white  text-md w-20 border" id="<?=$arr_key[2]?>">
                <?=$arr[2]?>
              </button>

              <button class="std-tog ml-2 text-sm text-black p-1 bg-white  text-md w-20 border" id="<?=$arr_key[3]?>">
                <?=$arr[3]?>
              </button>
            </div>
        <!-- </div> -->
        <div class="flex md:flex-row flex-col-reverse justify-between">
          <div class="overflow-y-scroll mt-5 md:w-9/12 md:mt-14 mt-5 h-96">
          <div class="form-header bg-red-500 text-white text-xs mt-2" id="del-std">
          </div>
            <div class="txt text-xl bg-blue-500 p-3 text-white sticky top-0">
              Students
            </div>
            <table class="bg-dark mt-4 text-center md:w-full tbl">
              <thead class="bg-darker text-xs">
                <th class="p-2 border-r-dark w-16">SN</th>
                <th class="p-2 border-r">MATRIC</th>
                <th class="p-2 border-r">Full Name</th>
                <th class="p-2 border-r" colspan="4">GP</th>
                <th class="p-2 border-r">CGPA</th>
                <th class="p-2 border-r" >SCORE</th>
                <th class="p-2" colspan="2">ACTION</th>
              </thead>

              <tbody class="text-xs" id="tbl_response">
                <?php
                  $select = "SELECT * FROM ((student INNER JOIN level on student.level = level.levelID) INNER JOIN gradepoint on student.stdID = gradepoint.stdID) WHERE student.level = '".$arr_key[0]."' ORDER BY matric ASC";
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
                  <td class="border-r border-t p-2"><?=$row["forth"]?></td>
                  <td class="border-r border-t p-2"><?=$row["cgpa"]?></td>

                  <td class="border-r border-t p-2 text-black flex">
                    <select name="<?=$i?>" class="w-full sem" id="sem<?=$i?>">
                      <option value="">Semester</option>
                      <option value="1">1<sup>st</sup></option>
                      <option value="2">2<sub>nd</sub></option>
                    </select>
                    <button class="btn bg-blue-700 w-full p-2 block score" id="<?=$row["levelID"]?>"><i class="fa fa-book-open text-white"></i></button>

                    <button class="btn bg-green-700 w-full p-2 block edit-score" id="<?=$row["stdID"]?>"><i class="far fa-eye text-white"></i></button>
                  </td>

                  <td class="border-r border-t p-2">
                    <a href="#" class="btn bg-green-700 w-full p-2 block"><i class="fa fa-edit"></i></a>
                  </td>
                  <td class="border-r border-t p-2">
                    <button class="btn bg-red-700 w-full p-2 block del-std" id="<?=$row["stdID"]?>"><i class="fa fa-trash-alt text-white"></i></button>
                  </td>
                </tr>
                <?php }?>
              </tbody>
            </table>
          </div>

          <div class="form-course md:w-3/12 lg:ml-1 md:mt-14 mt-5 border shadow p-2">
            <p class=" text-md bg-green-500 text-white mb-2 text-justify" id="edit-score-alert"></p>
            <div class="form-header bg-blue-500 text-white p-2 mt-2">
              Student Score
            </div>
            <div class="form-content mt-3">
              <form class="flex flex-col overflow-y-auto" method="POST" id="score_form">
                <span class="d-block text-md bg-green-700 text-white mb-2" id="mtr"></span>
                <div id="score_elem"></div>

                <div class="btn flex justify-end">
                  <button class="btn bg-green-500 p-2 text-white text-sm w-24 justify-self-end" style="align-self: flex-end;" id="add_score" name="add_score">
                    Add <i class="fa fa-plus"></i>
                  </button>

                  <button class="btn bg-green-500 p-2 text-white text-sm w-24 justify-self-end invisible absolute" style="align-self: flex-end;" id="edit-score" name="edit-score">
                    Update <i class='fa fa-edit'></i>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="form flex justify-center mt-4 w-full invisible" style="align-items: center;" id="form">
        <div class="form-body p-2 md:w-5/12 w-full shadow-md border absolute top-28 mt-2">
          <div class="form-header bg-red-400 text-white text-xs" id="alert">
          </div>

          <div class="form-header bg-blue-500 text-white p-2 mt-2">
            Add Student
          </div>
          <div class="form-content mt-3">
            <form class="flex flex-col" id="std" method="POST">
              <label for="title" class="text-sm font-bold">
                Full name
              </label>
              <input type="text" name="name[]" id="title" class="mb-3 border shadow block w-full h-8 p-5 text-md" placeholder="Full name" value="">

              <label for="title" class="text-sm font-bold">
                Matric N<u>0</u>
                <label for="err" class="text-red-500 text-xs md:inline block">
                </label>
              </label>
              <input type="text" name="matric[]" id="title" class="mb-3 border shadow block w-full h-8 p-5 text-md" placeholder="Matric N0" value="">

              <label for="user" class="font-bold text-md block">
                Level <sup class="text-md">*</sup>
              </label>

              <select name="lev" id="lev" class="border shadow text-xs w-full h-full p-3 border-l text-blue-400 rounded-none mb-3">
                <option class="text-xl" value="">....</option>
                  <option value="<?=$arr_key[0]?>"><?=$arr[0]?></option>
                  <option value="<?=$arr_key[1]?>"><?=$arr[1]?></option>
                  <option value="<?=$arr_key[2]?>"><?=$arr[2]?></option>
                  <option value="<?=$arr_key[3]?>"><?=$arr[3]?></option>
              </select>

              <button class="btn bg-green-500 p-2 text-white text-sm w-20 justify-self-end" style="align-self: flex-end;" id="add_std" name="add_std">
                Add <i class="fa fa-plus"></i>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php
  include "includes/footer.php";
?>
<script>
  var index = 0;
  var ind = 0;
  var bool = true;
  var state = true;

  onload = add_score();
  onload = std();
  onload = del_std();
  onload = view_score();
  document.querySelector("#add_std").addEventListener("click", function (e) {
    e.preventDefault();
    var form = new FormData(document.getElementById("std"));
    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        document.querySelector("#alert").classList.add("p-3");
        document.querySelector("#alert").innerText = this.responseText;
        if (this.responseText[this.responseText.length-1] == '*') {
          document.querySelector("#alert").classList.replace("bg-green-500", "bg-red-400");
        }else{
          document.querySelector("#alert").classList.replace("bg-red-400", "bg-green-500");
          for (let k = 0; k < document.querySelectorAll("#form input"); k++) {
            document.querySelectorAll("#form input")[k].value = "";
            document.querySelectorAll("#form select").value = "";
          }
        }
        table_load();
      }
    }
    xml.open("POST", "add_std.php", true);
    xml.send(form);
  })

  function add_score(){
    document.querySelector("#add_score").addEventListener("click", function (e) {
      e.preventDefault();
      var form = new FormData(document.querySelector("#score_form"));
      var xmlHttp = new XMLHttpRequest();
      xmlHttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          document.querySelector("#edit-score-alert").innerHTML = this.responseText;
          document.querySelector("#edit-score-alert").classList.add("p-2");
          if (this.responseText[this.responseText.length-1] == '*') {
            document.querySelector("#edit-score-alert").classList.replace("bg-green-500", "bg-red-500");
          }else{
            document.querySelector("#edit-score-alert").classList.replace("bg-red-500", "bg-green-500");
          }
        }
      }
      var val = document.querySelectorAll(".edit-score")[index].id+document.querySelectorAll(".score")[index].id+document.querySelectorAll(".sem")[index].value;
      xmlHttp.open("POST", "add-score.php?stdId="+val, true)
      xmlHttp.send(form);
    })
  }

  function edit_score(){
    if (!state) {
      document.querySelector("#edit-score").addEventListener("click", function (e) {
        e.preventDefault();
        var form = new FormData(document.querySelector("#score_form"));
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText)
            document.querySelector("#edit-score-alert").innerHTML = this.responseText;
            document.querySelector("#edit-score-alert").classList.add("p-2");
            if (this.responseText[this.responseText.length-1] == '*') {
              document.querySelector("#edit-score-alert").classList.replace("bg-green-500", "bg-red-500");
            }else{
              document.querySelector("#score_elem").innerHTML = this.responseText
            }
            state=!state;
          }
        }
        var val = document.querySelectorAll(".edit-score")[index].id+document.querySelectorAll(".score")[index].id+document.querySelectorAll(".sem")[index].value;
        xmlHttp.open("POST", "update-score.php?stdId="+val, true)
        xmlHttp.send(form);
      })

    }
  }
  function view_score(){
    for (let j = 0; j < document.querySelectorAll(".edit-score").length; j++) {
      document.querySelectorAll(".edit-score")[j].addEventListener("click", function (e) {
        if (document.querySelectorAll(".sem")[j].value != '') {

          document.querySelector("#edit-score").classList.remove("invisible")
          document.querySelector("#edit-score").classList.remove("absolute")
          document.querySelector("#add_score").classList.add("absolute")
          document.querySelector("#add_score").classList.add("invisible")
          bool=!bool;
          document.querySelector("#score_elem").innerHTML = "";

          e.preventDefault();
          document.querySelector("#mtr").innerText = document.querySelectorAll(".mt")[j].innerText;
          var xmlHttp = new XMLHttpRequest();
          state = !state;
          xmlHttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
              document.querySelector("#mtr").classList.add("p-2");
              document.querySelector("#score_elem").innerHTML = this.responseText;
              document.querySelector("#edit-score-alert").classList.remove("p-2");
              document.querySelector("#edit-score-alert").innerHTML = "";
              index = j;
              edit_score();
              state=!state;
            }
          }
          var val = document.querySelectorAll(".edit-score")[index].id+document.querySelectorAll(".score")[index].id+document.querySelectorAll(".sem")[index].value;
          xmlHttp.open("GET", "load-score.php?stdId="+val, true)
          xmlHttp.send();
        }
      })
    }
  }
  function del_std() {
    for (let j = 0; j < document.querySelectorAll(".del-std").length; j++) {
      document.querySelectorAll(".del-std")[j].addEventListener("click", function (e) {
        e.preventDefault();
        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
            document.querySelector("#del-std").innerHTML = this.responseText;
            document.querySelector("#del-std").classList.add("p-3");
            if (this.responseText[this.responseText.length-1] == '*') {
              document.querySelector("#del-std").classList.replace("bg-green-500", "bg-red-500");
            }else{
              document.querySelector("#del-std").classList.replace("bg-red-500", "bg-green-500");
            }
            table_load();
          }
        }
        xml.open("GET","delete.php?id=s"+document.querySelectorAll(".del-std")[j].id, true);
        xml.send();
      })
    }
  }

  function std(){
    for (let j = 0; j < document.querySelectorAll(".score").length; j++) {
        document.querySelectorAll(".score")[j].addEventListener("click", function (e) {
          if (document.querySelectorAll(".sem")[j].value != '') {
            e.preventDefault();

            document.querySelector("#edit-score").classList.add("invisible")
            document.querySelector("#edit-score").classList.add("absolute")
            document.querySelector("#add_score").classList.remove("absolute")
            document.querySelector("#add_score").classList.remove("invisible")
            bool=!bool;
            document.querySelector("#score_elem").innerHTML = "";

            var xmlHttp = new XMLHttpRequest();
            xmlHttp.onreadystatechange = function () {
              if (this.readyState == 4 && this.status == 200) {
                document.querySelector("#mtr").innerText = document.querySelectorAll(".mt")[j].innerText;
                document.querySelector("#mtr").classList.add("p-2");
                document.querySelector("#score_elem").innerHTML = this.responseText;
                document.querySelector("#edit-score-alert").classList.remove("p-2");
                document.querySelector("#edit-score-alert").innerHTML = "";
                index = j;
              }
            }
            xmlHttp.open("GET", "score.php?id="+document.querySelectorAll(".score")[j].id+document.querySelectorAll(".sem")[j].value, true)
            xmlHttp.send();
          }
      })
    }
  }

  for (let i = 0; i < document.querySelectorAll(".std-tog").length; i++) {
    document.querySelectorAll(".std-tog")[i].addEventListener("click", function (e) {
      var xml = new XMLHttpRequest();
      xml.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          // alert(this.responseText)
          document.querySelector("#tbl_response").innerHTML = this.responseText;
          for (let j = 0; j < document.querySelectorAll(".std-tog").length; j++) {
            document.querySelectorAll(".std-tog")[j].classList.replace("bg-blue-700", "bg-white");
            document.querySelectorAll(".std-tog")[j].classList.replace("text-white", "text-black");
            document.querySelectorAll(".std-tog")[i].classList.replace("bg-white", "bg-blue-700")
            document.querySelectorAll(".std-tog")[i].classList.replace("text-black", "text-white")
          }
          id = document.querySelectorAll(".std-tog")[i].id;
          ind = i;
          std();
          view_score();
          del_std();
          // edit_score();
        }
      }
      xml.open("GET", "load.php?id="+document.querySelectorAll(".std-tog")[i].id)
      xml.send();
    });
  }


  function table_load() {
    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function () {
      if(this.readyState == 4 && this.status == 200) {
        document.querySelector("#tbl_response").innerHTML = this.responseText;
      }
    }
    xml.open("GET", "load.php?id="+id, true);
    xml.send();
  }

</script>