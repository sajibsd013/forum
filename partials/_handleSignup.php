<?php
$showError = "false";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '_dbconnect.php';

    $user_name =  $_POST['signupName'];
    $user_email =  $_POST['signupEmail'];
    $birthday =  $_POST['signupBirthday'];
    $pass1 =  $_POST['signupPassword1'];
    $pass2 =  $_POST['signupPassword2'];

    $existsql = "SELECT * FROM `users` WHERE `user_email` = '$user_email'";

    $result = mysqli_query($conn , $existsql);
    $numRows = mysqli_num_rows($result);

    if ($numRows>0) {
        $showError = "Email already in use";
        header("Location: /forum/index.php?sinupsuccess=false&error=$showError");

    }
    else {
        if ($pass1 == $pass2) {
            $hashpass = password_hash($pass1, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_email`, `user_pass`,`user_name`,`birthday`) VALUES ('$user_email', '$hashpass','$user_name','$birthday')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $showAlert = true;
                $success= "<strong>Success! </strong>You can now login!";
                header("Location: /forum/index.php?success=$success");
            }
        }
        else {
            $showError = "Passwords do not match";
            header("Location: /forum/index.php?error=$showError");
        }
    }

}

?>