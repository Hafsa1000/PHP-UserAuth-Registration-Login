<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {

  $id = $_POST['data'];
  $user = $_POST['data2'];

  $host = " ";
  $username = " ";
  $password = " ";
  $database = "form";

  $conn = mysqli_connect($host, $username, $password, $database);

  
  $id = mysqli_real_escape_string($conn, $id);

  $sql = "SELECT * FROM users WHERE email='$id'";

  $result = mysqli_query($conn, $sql);

  $row = mysqli_fetch_assoc($result);

  if($user == "User"){
    $sql = "UPDATE users SET user_type='Engineer' WHERE email='$id'";
  }elseif($user == "Engineer"){
    $sql = "UPDATE users SET user_type='User' WHERE email='$id'";
  }

  mysqli_query($conn, $sql);

  mysqli_close($conn);

  header("location: admin.php");
}
