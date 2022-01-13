<?php
  session_start();
  if (!isset($_SESSION["userid"], $_SESSION["password"])) {
    header("location: ./index.php");
  }
?>