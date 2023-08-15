<?php

function getUser($user) {
    require $_SERVER['DOCUMENT_ROOT'].'/PRMS/db/dbcon.php';

    $sql = "SELECT * FROM user_account WHERE username= ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $user);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $userDetails = [];
    if ($row = mysqli_fetch_assoc($result)) {
        $userDetails = $row;
    }

    mysqli_close($conn);
    return $userDetails;
}

function updateAccount($user){
    require $_SERVER['DOCUMENT_ROOT'].'/PRMS/db/dbcon.php';

    if(isset($_POST['username'], $_POST["password"], $_POST["fullname"], $_POST["address"], $_POST["email"], $_POST["phone"], $_POST["degree"])) {
        $username = $_POST['username'];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $fullname = $_POST["fullname"];
        $address = $_POST["address"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $degree = $_POST["degree"];


        // Using a prepared statement
        $stmt = $conn->prepare("UPDATE user_account SET username=?, password=?, fullname=?, address=?, email=?, phone=?, degree=? WHERE username=?");
        $stmt->bind_param("ssssssss", $username, $password, $fullname, $address, $email, $phone, $degree, $user);
        
        if ($stmt->execute()) {
            session_start();  // Ensure session is started
            $_SESSION['success_message'] = "User updated successfully.";
            header('Location: /PRMS/user/account.php');
            exit;
        } else {
            session_start();
            $_SESSION['error_message'] = "Error updating user.";
            header('Location: /PRMS/user/account.php');
            exit;
        }
    } else {
        // Handle case where not all expected inputs are set.
        // Redirect to error page or show an error message.
    }
}

?>
