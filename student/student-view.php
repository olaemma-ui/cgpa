<?php include '../includes/connect.php';?>
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
        <nav class="navbar wrapper sticky top-0 shadow-xl p-1 bg-blue-500 flex justify-between" style="z-index: 99;">
            <a href="home.php" class="brand p-1 text-white md:text-3xl text-xl">CGPA</a>

            <button class="bars text-white text-2xl lg:invisible visible pr-2">
                <?=$_GET['matric']?>
            </button>
        </nav>

        <?php 
            $select = "SELECT * from student 
            inner join gradepoint on student.stdId = gradepoint.stdId 
            inner join std_score on student.stdId = std_score.stdID 
            inner join course on std_score.courseID = course.course_id 
            where student.matric = '".$_GET['matric']."'";

            $query = mysqli_query($con, $select);
            $gp = array();
            $cgpa = 0.00;
        ?>
        <div class="flex flex-wrap">
            <div class="nd1 w-1/2 p-2">
                <header class="nd1 bg-dark p-3">
                    <h3>1<sup>st</sup> Semester ND1</h3>
                </header>
                <?php 
                    while ($row = mysqli_fetch_array($query)) {
                        // print_r($row);
                        $gp[0] = $row['first'];
                        $gp[1] = $row['second'];
                        $gp[2] = $row['third'];
                        $gp[3] = $row['fourth'];
                        $cgpa = $row['cgpa'];

                        if ($row['semester'] == 1){
                            ?>
                                <div class="result flex justify-between shadow pl-3 pr-3" style='font-size: 20px; border-bottom: solid 1px grey'>
                                    <p class='course pt-2'><?=$row['course_title']?><p>
                                    <p class="score p-2" style='border-left: solid 2px grey;'><?=$row['score']?></p>
                                </div>
                            <?php
                        }
                    }
                ?>

                <p class="score" style='font-size: 20px;'>GPA: <?=$gp[0]?></p>
            </div>

            <div class="nd1 w-1/2 p-2">
                <header class="nd1 bg-dark p-3">
                    <h3>2<sup>nd</sup> Semester ND1</h3>
                </header>
                <?php 
                    while ($row = mysqli_fetch_array($query)) {
                        // print_r($row);
                        if ($row['semester'] == 2){
                            ?>
                                <div class="result flex justify-between shadow pl-3 pr-3" style='font-size: 20px; border-bottom: solid 1px grey'>
                                    <p class='course pt-2'><?=$row['course_title']?><p>
                                    <p class="score p-2" style='border-left: solid 2px grey;'><?=$row['score']?></p>
                                </div>
                            <?php
                        }
                    }
                ?>

                <p class="score" style='font-size: 20px;'>GPA: <?=$gp[1]?></p>
            </div>


            <div class="nd1 w-1/2 p-2">
                <header class="nd1 bg-dark p-3">
                    <h3>1<sup>st</sup> Semester ND2</h3>
                </header>
                <?php 
                    while ($row = mysqli_fetch_array($query)) {
                        // print_r($row);
                        if ($row['semester'] == 3){
                            ?>
                                <div class="result flex justify-between shadow pl-3 pr-3" style='font-size: 20px; border-bottom: solid 1px grey'>
                                    <p class='course pt-2'><?=$row['course_title']?><p>
                                    <p class="score p-2" style='border-left: solid 2px grey;'><?=$row['score']?></p>
                                </div>
                            <?php
                        }
                    }
                ?>

                <p class="score" style='font-size: 20px;'>GPA: <?=$gp[2]?></p>
            </div>


            <div class="nd1 w-1/2 p-2">
                <header class="nd1 bg-dark p-3">
                    <h3>2<sup>nd</sup> Semester ND2</h3>
                </header>
                <?php 
                    while ($row = mysqli_fetch_array($query)) {
                        // print_r($row);
                        if ($row['semester'] == 4){
                            ?>
                                <div class="result flex justify-between shadow pl-3 pr-3" style='font-size: 20px; border-bottom: solid 1px grey'>
                                    <p class='course pt-2'><?=$row['course_title']?><p>
                                    <p class="score p-2" style='border-left: solid 2px grey;'><?=$row['score']?></p>
                                </div>
                            <?php
                        }
                    }
                ?>

                <p class="score" style='font-size: 20px;'>GPA: <?=$gp[3]?></p>
            </div>
        </div>

        <h1 class='p-2 bg-dark' style='font-size: 20px; float: right'>
            CGPA: <?=$cgpa?>
        </h1>
    </body>

</html>