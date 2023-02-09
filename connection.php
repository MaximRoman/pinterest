<?php
  $connect = mysqli_connect("localhost", "root", "", "pinterest");

  if (!$connect) {
    die("SQL Connection faild!");
  }
?>