<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../CSS Files/afterlogin.css"> 
</head>

<body>

<?php if(isset($_SESSION['username'])): ?>

  <div class="txt">
    <h1>Login Successful!</h1>  
    <p>Account Type: User</p>
    <a href="./logout.php"><button style="border: none;
    border-radius: 5px;
    width: 150px;
    height: 35px;
    padding: 5px 10px;  
    background-color: black;
    color: white; ">Log Out</button></a>
  </div>

<?php else: ?>

  <h1>Please log in to access the dashboard.</h1>

  <a href="../index.html"><button style="border: none;
    border-radius: 5px;
    width: 150px;
    height: 35px;
    padding: 5px 10px;  
    background-color: black;
    color: white; ">Go to Log In</button></a>
  
<?php endif; ?>

</body>

</html>