<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email;
    $userPassword;

    // Validating input
    // Email
    if (empty ($_POST["email"])) {  
        $errMsg = "Error! You didn't enter the email.";  
        echo $errMsg;  
        exit();
    }else {  
        $email = $_POST["email"];  
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {  
            $emailErr = "Invalid email format";  
            exit($emailErr);
        }  
    } 

    // Password
    if (empty ($_POST["password"])) {  
        $errMsg = "Error! You didn't enter the password.";  
        echo $errMsg;  
        exit();
    }else {  
        $userPassword = $_POST["password"];
        $userPassword = trim($userPassword); 
    }    
    
    // Hashing the password
    $hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);

    // Connecting database
    $host = " ";
    $username = " ";
    $password = " ";
    $database = "form";

    $conn = mysqli_connect($host, $username, $password, $database);

    // Checking if the email exists in the database
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);
        if ($user["user_type"] == "Admin"){
            session_start();
            $_SESSION['username'] = $email;
            $adminPassword = password_hash($user["password"], PASSWORD_DEFAULT);
            if (password_verify($userPassword, $adminPassword)) {
                header("Location: admin.php"); 
                exit();
            } else {
                echo "Incorrect password. Please try again.";
                exit();
            }
        }
        // Verifying the password
        if (password_verify($userPassword, $user["password"])) {
            session_start();
            $_SESSION['username'] = $email;
            if($user["user_type"] == "User"){
                header("Location: user.php"); 
            }

            if($user["user_type"] == "Engineer"){
                header("Location: engineer.php"); 
            }  
        } else {
            echo "Incorrect password. Please try again.";
            exit();
        }
    } else {
        echo "User not found. Please sign up.";
        exit();
    }

    mysqli_close($conn);
}
?>
