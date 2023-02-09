<?php 
  require './connection.php';

  if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    if (isset($_GET['image'])) {
      $image = $_GET['image'];
      unlink($image);
    }
    $sql = "DELETE FROM images WHERE id = '${id}'";
    if (mysqli_query($connect, $sql)) {
      header("Location: ./index.php?message=Success");
    } else {
      header("Location: ./index.php?message=SQL error!");
    }
  } else {
    header("Location: ./index.php");
  }
?>