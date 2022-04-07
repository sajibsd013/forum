<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '_dbconnect.php';
    $loginEmail =  $_POST['loginEmail'];
    $loginPass =  $_POST['loginPassword'];

    $sql = "SELECT * FROM `users` WHERE `user_email` = '$loginEmail'";
    $result = mysqli_query($conn , $sql);
    $numRows = mysqli_num_rows($result);

    if ($numRows == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            $user_type = $row['user_type'];
            $user_id = $row['id'];
            $user_name = $row['user_name'];
            $user_email = $row['user_email'];
            $birthday = $row['birthday'];
            $user_pass_hash = $row['user_pass'];
            if(password_verify($loginPass, $user_pass_hash)){
                session_start();
                $_SESSION["loggedin"] = true;
                $_SESSION["userName"] =  $user_name;
                $_SESSION["userEmail"] =   $user_email;
                $_SESSION["birthday"] =   $birthday;
                $_SESSION["userId"] =   $user_id;
                $_SESSION["userType"] =   $user_type;
                header("Location: /forum/index.php");
            }
               $showError = "Passwords do not match";
                header("Location: /forum/index.php?error=$showError");
            }
        }
    else {
        $showError = "User not found";
        header("Location: /forum/index.php?error=$showError");
    }
}
?>