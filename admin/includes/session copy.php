<?php
  session_start();
  if (!isset($_SESSION["username"], $_SESSION["password"])) {
    header("location: ./index.php");
  }
?>