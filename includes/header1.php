<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NACOS</title>
  <link rel="stylesheet" href="assets/fontawesome-free-5.14.0-web/css/all.css">
  <link rel="stylesheet" href="assets/style.css">
  <link rel="stylesheet" href="assets/main.css">
</head>
<body class="bg-white overflow-y-auto overflow-x-hidden">
<?php
  // error_reporting(0);
  // include "includes/session.php";
  include "includes/connect.php";
?>

<nav class="navbar wrapper sticky top-0 shadow-xl p-1 bg-blue-500 flex justify-between" style="z-index: 99;">
  <a href="home.php" class="brand p-1 text-white md:text-3xl text-xl">CGPA</a>

  <button class="bars text-white text-2xl lg:invisible visible pr-2" id="btn">
    <i class="fa fa-bars" id="ic"></i>
  </button>
</nav>
  <div class="sidebar shadow-xl z-50 fixed h-full overflow-y-auto sidebar lg:visible invisible lg:w-2/12 w-6/12 bg-blue-500 mt-0.5 flex flex-col justify-etween overflow-y-auto" id="sidebar">
    <ul class="h-full w-full md:mt-4">
      <li class="list w-full shadow mt-3">
        <a href="dashboard.php" class="p-3 pt-4 hover:bg-blue-400 hover:animate-pulse border-b-darker block w-full text-white flex justify-between" style="align-items:center">Dashboard <i class="fa fa-chart-bar lg:visible invisible"></i></a>
      </li>

      <li class="list w-full shadow mt-3">
        <a href="course.php" class="p-3 pt-4 hover:bg-blue-400 hover:animate-pulse border-b-darker block w-full text-white flex justify-between" style="align-items:center">Courses <i class="fa fa-book lg:visible invisible"></i></a>
      </li>

      <li class="list w-full shadow mt-3">
        <a href="student.php" class="p-3 pt-4 hover:bg-blue-400 hover:animate-pulse border-b-darker block w-full text-white flex justify-between" style="align-items:center">Students <i class="fa fa-graduation-cap lg:visible invisible"></i></a>
      </li>

    </ul>
    <ul class="fixed bottom-2">
      <li class="list p-1 bg-red-500 hover:bg-red-400 md:w-40">
        <a href="./logout.php" class="link text-white w-full block p-1 md:p-2 w-full">Logout</a>
      </li>
    </ul>
  </div>