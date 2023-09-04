<?php

session_start();

?>

<html>
    <head>
        <link rel="stylesheet" href="../CSS Files/admin.css">
    </head>
    <body>
    <?php if(isset($_SESSION['username'])): ?>
        <div class="txt">
            <h1>Login Successful!</h1>
            <p>Account Type: Admin</p>
        </div>
        <?php
        // Database connection code
        $host = " ";
        $username = " ";
        $password = " ";
        $database = "form";

        $conn = mysqli_connect($host, $username, $password, $database);



        $sql = "SELECT name, email, user_type FROM users";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        ?>
        <div class="table">
            <table class="myTable">
                <tr>
                <th>Sr No</th>
                <th>Name</th>
                <th>Email</th>  
                <th>User Type</th>
                <th></th>
                <th></th>
                </tr>
            <?php  
            $index = 1;
            while($row = $result->fetch_assoc()) {
                if($row["user_type"] != 'Admin') {  
            ?>
                <tr>
                <td><?php echo $index; ?></td>
                <td><?php echo $row["name"]; ?></td>
                <td><?php echo $row["email"]; ?></td>
                <td><?php echo $row["user_type"]; ?></td>  
                <td>
                <?php if($row["user_type"] == "User"): ?>
                    <td>                    
                        <form action="./update_user.php" method="post">
                            <input type="hidden" name="data2" value="<?php echo $row["user_type"]; ?>">
                            <input type="hidden" name="data" value="<?php echo $row["email"]; ?>">
                            <button type="submit" class="btn">Change to Engineer</button>
                        </form>
                    </td>
                <?php elseif($row["user_type"] == "Engineer"): ?>
                    <td>                    
                    <form action="./update_user.php" method="post">
                        <input type="hidden" name="data2" value="<?php echo $row["user_type"]; ?>">
                        <input type="hidden" name="data" value="<?php echo $row["email"]; ?>">
                        <button type="submit" class="btn">Change to User</button>
                    </form>
                    </td>
                <?php endif; ?>
                </td> 
                </tr>
            <?php
                $index = $index + 1;
                }
            }
            ?>  
            </table>
        </div>
        <div class="logOut" style="margin: 30px 45%;">
            <a href="./logout.php"><button style="border: none;
                border-radius: 5px;
                width: 150px;
                height: 35px;
                padding: 5px 10px;  
                background-color: black;
                color: white; ">Log Out</button></a>
        </div>
        <?php
        } else {
        echo "0 results";
        }
        $conn->close();
        ?>
    <?php else: ?>
        <h1>Please log in to access the dashboard.</h1>
        <a href="../index.html" style="margin-left: 45%;"><button style="border: none;
        border-radius: 5px;
        width: 150px;
        height: 35px;
        padding: 5px 10px;  
        background-color: black;
        color: white; ">Go to Log In</button></a>
    <?php endif; ?>
    </body>
</html>
