<?php 
include "connect.php";
session_start();
if (isset($_POST['cancel'])){
    $id = $_POST['ma'];
      $sql = "UPDATE oder_online SET trangthai= 3 where ma = $id";
      mysqli_query($conn, $sql);
      header("location:history.php");
     }

  ?>