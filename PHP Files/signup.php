<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = "";
    $email = "";
    $userPassword = "";

    // Validating input
    // Name
    if (empty ($_POST["name"])) {  
        $errMsg = "Error! You didn't enter the email.";  
        echo $errMsg;  
        exit();
    }else{
        $name = $_POST["name"];
        $pattern = "/^[A-Za-z\s'.]+$/";

        if (!preg_match($pattern, $name)) {
            $nameErr = "Only alphabets, white space, apostrophes, and full stops are allowed";
            exit($nameErr);
        }
        $name = preg_replace("/'/", "''", $name);

    }

    // Email
    if (empty ($_POST["email"])) {  
        $errMsg = "Error! You didn't enter the email.";  
        echo $errMsg;  
        exit();
    }else {  
        $email = $_POST["email"];  
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {  
            $emailErr = "Invalid email format";  
            echo $emailErr;
            exit();
        }  
    } 

    // password
    if (empty ($_POST["password"])) {  
        $errMsg = "Error! You didn't enter the password.";  
        echo $errMsg;  
        exit();
    }else {  
        $userPassword = $_POST["password"];
        $userPassword = trim($userPassword); 
        // Minimum password length
        if (strlen($userPassword) < 8) {
            echo "Password should be at least 8 characters long.";
            exit();
        }

        // Checking for at least one uppercase letter
        if (!preg_match('/[A-Z]/', $userPassword)) {
            echo "Password should contain at least one uppercase letter.";
            exit();
        }

        // Checking for at least one lowercase letter
        if (!preg_match('/[a-z]/', $userPassword)) {
            echo "Password should contain at least one lowercase letter.";
            exit();
        }

        // Checking for at least one digit
        if (!preg_match('/[0-9]/', $userPassword)) {
            echo "Password should contain at least one digit.";
            exit();
        }

        // Checking for at least one special character
        if (!preg_match('/[^a-zA-Z0-9]/', $userPassword)) {
            echo "Password should contain at least one special character.";
            exit();
        } 
    } 

    if($_POST["confirm_password"] != $userPassword){
        echo "Passwords do not match!";
        exit;
    }

    // Hashing the password
    $hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);

    // Connecting database
    $host = " ";
    $username = " ";
    $password = " ";
    $database = " ";

    $conn = mysqli_connect($host, $username, $password, $database);

    $sql = "SELECT email FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "Email already registered. Please login.";
        echo '<meta http-equiv="refresh" content="2;url=../index.html">';
        exit();
    }

    $type = "User";

    // Inserting user data into the database
    $insertQuery = "INSERT INTO users (name, email, user_type, password) VALUES ('$name', '$email', '$type', '$hashedPassword')";

    if (mysqli_query($conn, $insertQuery)) {
        echo "Sign Up Successful!, Now you can Log In.";
        exit;
    } else {
        echo "Error: " . $insertQuery . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
