
<!-- md:top-60 md:absolute -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NACOS</title>
  <link rel="stylesheet" href="../assets/fontawesome-free-5.14.0-web/css/all.css">
  <link rel="stylesheet" href="../assets/style.css">
  <link rel="stylesheet" href="../assets/main.css">
</head>
<body class="bg-white overflow-y-auto overflow-x-hidden">
  <div class="testimonials md:fixed md:top-0 w-full">
    <div class="color p-3 border-b-dark pb-5 md:pt-20 md:h-96 h-40 text-white bg-img-color">
      <p class="txt text-white md:text-7xl text-3xl text-center">RESULT CHECKING</p>
      <span class="block text-center md:text-xl text-xs">
        CGPA (Cumulative Grade Point Average) Calculator and Result Checking
      </span>
    </div>
  </div>

  <div class="w-full flex justify-center">

      <div class="form relative md:top-80 bottom-14 lg:w-5/12 md:w-8/12 w-11/12">
        <div class="form-body p-3 bg-white shadow-xl border">
          <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["view"])) {
              include '../includes/validate.php';
              if(empty($matric_err)){
                header('location: student-view.php?matric='.$matric[0]);
              }
              if (isset($alert)) {?>
                <div class="alert mb-5 md:mt-0 p-3 bg-red-400 rounded text-white shadow-md">
                  <?=$alert?>
                </div>
            <?php }
            }
          ?>
          <form action="<?= htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
              <div class="txt text-black text-center md:text-3xl bg-blue-500 text-white text-xl mb-8 pt-3 pb-4">
                Student Result
              </div>
            <span class="md:inline block md:text-md text-black txt mb-2 mt-3">Matric Number: </span>
              <label for="err" class="md:pl-5 text-red-400 text-xs md:inline block">
                <?php
                  if (isset($matric_err[0])) {
                    echo $matric_err[0];
                  }
                ?>
              </label>

            <input type="text" name="matric[]" placeholder="00/00/0000" class="txt p-1 text-blue-400 w-full bg-white shadow-md border mb-4 h-14 border-b-dark"
            value="<?php
                if (isset($matric[0])) {
                  echo $matric[0];
                }
              ?>"
              >
            <button class="btn bg-green-500 text-white p-3 mt-3" name="view">
              View Result <i class="fa fa-book-open"></i>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  </body>

</html>