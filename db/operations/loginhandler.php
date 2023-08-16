<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uname = $_POST["uname"];
    $pass = $_POST["psw"];

    // Include database connection
    require $_SERVER['DOCUMENT_ROOT'].'/PRMS/db/dbcon.php';

    $sql = "SELECT * FROM user_account WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $uname);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
      if (password_verify($pass, $row["password"])) { 
            session_start();

            $_SESSION["username"] = $uname;
            $_SESSION["type"] = $row["type"];
            
            if($row['type'] == 'nurse') {
                header('Location: /PRMS/control/user.php'); // Redirect to admin dashboard
                exit;
            } elseif ($row['type'] == 'normal') {
                // Your logging logic
                $sql = "INSERT INTO log (user, time, date, type) VALUES (?, NOW(), CURDATE(), ?)";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "ss", $uname, $row['type']);
                if (mysqli_stmt_execute($stmt)) {
                    header('Location: /PRMS/user/user.php'); // Redirect to user dashboard
                    exit;
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            }
        } else {
            $_SESSION['error_message'] = "Password incorrect.";
            header('Location: /PRMS/login.php');
            exit;
          }
    } else {
            $_SESSION['error_message'] = "Username does not exist in our records.";
            header('Location: /PRMS/login.php');
            exit;
      }
    mysqli_close($conn);
} else {
    include 'sessionerror.php';
}
?>
