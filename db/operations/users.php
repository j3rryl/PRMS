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

function getUserById($user) {
    require $_SERVER['DOCUMENT_ROOT'].'/PRMS/db/dbcon.php';

    $sql = "SELECT * FROM user_account WHERE ID= ?";
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

function getPatients() {
    require $_SERVER['DOCUMENT_ROOT'].'/PRMS/db/dbcon.php';

    $sql = "SELECT * FROM user_account WHERE type='normal'";
    $result = mysqli_query($conn, $sql);
    
    $userDetails = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $userDetails[] = $row;
    }

    mysqli_close($conn);
    return $userDetails;
}

function getAllUsers() {
    require $_SERVER['DOCUMENT_ROOT'].'/PRMS/db/dbcon.php';

    $sql = "SELECT * FROM user_account";
    $result = mysqli_query($conn, $sql);
    
    $userDetails = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $userDetails[] = $row;
    }

    mysqli_close($conn);
    return $userDetails;
}

function getUserHealth($id) {
    require $_SERVER['DOCUMENT_ROOT'].'/PRMS/db/dbcon.php';

    $sql = "SELECT * FROM body_health 
    JOIN user_account ON body_health.user_id = user_account.ID
    WHERE body_health.id= ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $userDetails = [];
    if ($row = mysqli_fetch_assoc($result)) {
        $userDetails = $row;
    }

    mysqli_close($conn);
    return $userDetails;
}
function getUsersHealth($user, $test_type="before") {
    require $_SERVER['DOCUMENT_ROOT'].'/PRMS/db/dbcon.php';

    $sql = "SELECT * FROM body_health WHERE user_id= ? AND test_type= ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "is", $user, $test_type);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $userDetails = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $userDetails[] = $row;
    }

    mysqli_close($conn);
    return $userDetails;
}

function getAllUsersHealth($test_type="before") {
    require $_SERVER['DOCUMENT_ROOT'].'/PRMS/db/dbcon.php';

    $sql = "SELECT * FROM body_health 
JOIN user_account ON body_health.user_id = user_account.ID
WHERE body_health.test_type = ?;";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $test_type);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $userDetails = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $userDetails[] = $row;
    }

    mysqli_close($conn);
    return $userDetails;
}

function updateAccount() {
    require $_SERVER['DOCUMENT_ROOT'].'/PRMS/db/dbcon.php';

    session_start();  // Ensure session is started

    if (isset($_POST['username'], $_POST["password"], $_POST["fullname"], $_POST["address"], $_POST["email"], $_POST["phone"])) {
        $username = $_POST['username'];

        // Check if password is being changed
        $password = (isset($_POST["password"]) && !empty($_POST["password"])) 
                     ? password_hash($_POST["password"], PASSWORD_DEFAULT)
                     : null;

        $fullname = $_POST["fullname"];
        $address = $_POST["address"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];

        if ($password) {
            $stmt = $conn->prepare("UPDATE user_account SET password=?, fullname=?, address=?, email=?, phone=? WHERE username=?");
            $stmt->bind_param("ssssss", $password, $fullname, $address, $email, $phone, $username);
        } else {
            $stmt = $conn->prepare("UPDATE user_account SET fullname=?, address=?, email=?, phone=? WHERE username=?");
            $stmt->bind_param("sssss", $fullname, $address, $email, $phone, $username);
        }

        if ($stmt->execute()) {
            $_SESSION['success_message'] = "User updated successfully.";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        } else {
            $_SESSION['error_message'] = "Error updating user.";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    } else {
        $_SESSION['error_message'] = "Required inputs missing.";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
}


function newUser(){
    require $_SERVER['DOCUMENT_ROOT'].'/PRMS/db/dbcon.php';

    if(isset($_POST['type'], $_POST["username"], $_POST["fullname"], $_POST["password"], $_POST["email"], $_POST["address"], $_POST["phone"], $_POST["dob"])) {
        
        $type = $_POST['type'];
        $username = $_POST["username"];
        $fullname = $_POST["fullname"]; 
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);  // Hash the password
        $email = $_POST["email"]; 
        $address = $_POST["address"]; 
        $phone = $_POST["phone"]; 
        $dob = $_POST["dob"];
        
        // Check if username exists
        $stmt = $conn->prepare("SELECT ID FROM `user_account` WHERE `username` = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            session_start();
            $_SESSION['error_message'] = "Username already exists.";
            header('Location: /PRMS/admin/reports.php');
            exit;
        }

        // Using a prepared statement for inserting user
        $stmt = $conn->prepare("INSERT INTO `user_account` (`ID`,`type`, `username`, `fullname`, `password`, `email`, `address`, `phone`, `dob`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $type, $username, $fullname, $password, $email, $address, $phone, $dob);
        
        if ($stmt->execute()) {
            session_start();
            $_SESSION['success_message'] = "User added successfully.";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        } else {
            session_start();
            $_SESSION['error_message'] = "Error adding user.";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    } else {
        // Handle case where not all expected inputs are set.
        echo "Some inputs are missing."; // You can provide a more specific error message or redirection here.
    }
}


function newTest($user){
    require $_SERVER['DOCUMENT_ROOT'].'/PRMS/db/dbcon.php';

    if(isset(
    $_POST['user_id'], $_POST["test_type"],
    $_POST["magnesium"], $_POST["phosphate"], $_POST["potassium"], 
    $_POST["sodium"], $_POST["calcium"], $_POST["blood_flow_rate"],
    $_POST["dialysate_flow_rate"], $_POST["urea"], $_POST["creatinine"],
    $_POST["haemoglobin"], $_POST["blood_pressure"], $_POST["heart_rate"],
    $_POST["body_weight"], $_POST["temperature"], $_POST["oxygen_saturation"]


     )) {
        $user_id = $_POST['user_id']; 
        $test_type = $_POST["test_type"];
        $magnesium = $_POST["magnesium"]; 
        $phosphate = $_POST["phosphate"]; 
        $potassium = $_POST["potassium"]; 
        $sodium = $_POST["sodium"]; 
        $calcium = $_POST["calcium"]; 
        $blood_flow_rate = $_POST["blood_flow_rate"];
        $dialysate_flow_rate = $_POST["dialysate_flow_rate"]; 
        $urea = $_POST["urea"]; 
        $creatinine = $_POST["creatinine"];
        $haemoglobin = $_POST["haemoglobin"]; 
        $blood_pressure = $_POST["blood_pressure"]; 
        $heart_rate = $_POST["heart_rate"];
        $body_weight = $_POST["body_weight"]; 
        $temperature = $_POST["temperature"]; 
        $oxygen_saturation = $_POST["oxygen_saturation"];


        // Using a prepared statement
        $stmt = $conn->prepare("
        INSERT INTO `body_health` (`id`,`user_id`, `test_type`, `magnesium`, `phosphate`, `potassium`, `sodium`, `calcium`, `blood_flow_rate`, `dialysate_flow_rate`, `urea`, `creatinine`, `haemoglobin`, `blood_pressure`, `heart_rate`, `body_weight`, `temperature`, `oxygen_saturation`, `date`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, current_timestamp());
        
        
        ");
        $stmt->bind_param("sssssssssssssssss", $user_id, $test_type, $magnesium, 
        $phosphate, $potassium, $sodium, 
        $calcium, $blood_flow_rate,$dialysate_flow_rate,
        $urea, $creatinine,$haemoglobin,
        $blood_pressure, $heart_rate,$body_weight,
        $temperature, $oxygen_saturation);
        
        if ($stmt->execute()) {
            session_start();  // Ensure session is started
            $_SESSION['success_message'] = "Test added successfully.";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        } else {
            session_start();
            $_SESSION['error_message'] = "Error adding test.";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    } else {
        // Handle case where not all expected inputs are set.
        // Redirect to error page or show an error message.
    }
}

function updateTest() {
    require $_SERVER['DOCUMENT_ROOT'].'/PRMS/db/dbcon.php';

    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // Fetch current values
        $stmt = $conn->prepare("SELECT * FROM `body_health` WHERE `id` = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $currentValues = $result->fetch_assoc();

        // If the specific input is not set, use the current value
        $test_type = $_POST["test_type"] ?? $currentValues["test_type"];
        $magnesium = $_POST["magnesium"] ?? $currentValues["magnesium"];
        $phosphate = $_POST["phosphate"] ?? $currentValues["magnesium"]; 
        $potassium = $_POST["potassium"] ?? $currentValues["potassium"]; 
        $sodium = $_POST["sodium"] ?? $currentValues["sodium"]; 
        $calcium = $_POST["calcium"] ?? $currentValues["calcium"]; 
        $blood_flow_rate = $_POST["blood_flow_rate"] ?? $currentValues["blood_flow_rate"];
        $dialysate_flow_rate = $_POST["dialysate_flow_rate"] ?? $currentValues["dialysate_flow_rate"]; 
        $urea = $_POST["urea"] ?? $currentValues["urea"]; 
        $creatinine = $_POST["creatinine"] ?? $currentValues["creatinine"];
        $haemoglobin = $_POST["haemoglobin"] ?? $currentValues["haemoglobin"]; 
        $blood_pressure = $_POST["blood_pressure"] ?? $currentValues["blood_pressure"]; 
        $heart_rate = $_POST["heart_rate"] ?? $currentValues["heart_rate"];
        $body_weight = $_POST["body_weight"] ?? $currentValues["body_weight"]; 
        $temperature = $_POST["temperature"] ?? $currentValues["temperature"]; 
        $oxygen_saturation = $_POST["oxygen_saturation"] ?? $currentValues["oxygen_saturation"];

        // Using a prepared statement to update
        $stmt = $conn->prepare("UPDATE `body_health` SET 
            `test_type` = ?, 
            `magnesium` = ?, 
            `phosphate` = ?, 
            `potassium` = ?, 
            `sodium` = ?, 
            `calcium` = ?, 
            `blood_flow_rate` = ?, 
            `dialysate_flow_rate` = ?, 
            `urea` = ?, 
            `creatinine` = ?, 
            `haemoglobin` = ?, 
            `blood_pressure` = ?, 
            `heart_rate` = ?, 
            `body_weight` = ?, 
            `temperature` = ?, 
            `oxygen_saturation` = ?, 
    `date` = current_timestamp() 
            WHERE `id` = ?"); 

$stmt->bind_param("sssssssssssssssss", $test_type, $magnesium, 
$phosphate, $potassium, $sodium, 
$calcium, $blood_flow_rate,$dialysate_flow_rate,
$urea, $creatinine,$haemoglobin,
$blood_pressure, $heart_rate,$body_weight,
$temperature, $oxygen_saturation, $id);
        
        if ($stmt->execute()) {
            session_start();
            $_SESSION['success_message'] = "Test updated successfully.";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        } else {
            session_start();
            $_SESSION['error_message'] = "Error updating test.";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    } else {
        echo "error, no id"; // Handle case where the ID or other necessary inputs are not set.
    }
}


function getMonthlyTestCounts() {
    require $_SERVER['DOCUMENT_ROOT'].'/PRMS/db/dbcon.php';

    $sql = "SELECT COUNT(id) as test_count, MONTH(date) as month, YEAR(date) as year 
            FROM body_health 
            GROUP BY YEAR(date), MONTH(date)
            ORDER BY YEAR(date), MONTH(date)";
    
    $result = mysqli_query($conn, $sql);
    
    $monthlyCounts = [];
    $monthNames = [
        1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 
        6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 
        10 => 'October', 11 => 'November', 12 => 'December'
    ];

    while ($row = mysqli_fetch_assoc($result)) {
        // $formattedMonth = $monthNames[$row['month']] . " " . $row['year'];  // Example: "April 2023"
        $formattedMonth = $monthNames[$row['month']];  
        $monthlyCounts[$formattedMonth] = $row['test_count'];
    }

    mysqli_close($conn);
    return $monthlyCounts;
}

function getMonthlyUserCounts() {
    require $_SERVER['DOCUMENT_ROOT'].'/PRMS/db/dbcon.php';

    $sql = "SELECT COUNT(ID) as test_count, MONTH(date_added) as month, YEAR(date_added) as year 
            FROM user_account 
            GROUP BY YEAR(date_added), MONTH(date_added)
            ORDER BY YEAR(date_added), MONTH(date_added)";
    
    $result = mysqli_query($conn, $sql);
    
    $monthlyCounts = [];
    $monthNames = [
        1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 
        6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 
        10 => 'October', 11 => 'November', 12 => 'December'
    ];

    while ($row = mysqli_fetch_assoc($result)) {
        // $formattedMonth = $monthNames[$row['month']] . " " . $row['year'];  // Example: "April 2023"
        $formattedMonth = $monthNames[$row['month']];  
        $monthlyCounts[$formattedMonth] = $row['test_count'];
    }

    mysqli_close($conn);
    return $monthlyCounts;
}
function deleteTestById() {
    require $_SERVER['DOCUMENT_ROOT'].'/PRMS/db/dbcon.php';

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
    // Using a prepared statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM body_health WHERE id = ?");
    $stmt->bind_param("s", $id);

    if ($stmt->execute()) {
        session_start();
        $_SESSION['success_message'] = "Test deleted successfully.";
        header('Location: /PRMS/admin/reports.php');
        exit;
    } else {
        session_start();
        $_SESSION['error_message'] = "Error deleting test.";
        header('Location: /PRMS/admin/reports.php');
        exit;
    }
    } else {
        echo "Not set";
    }
}


function deleteUserByUsername() {
    require $_SERVER['DOCUMENT_ROOT'].'/PRMS/db/dbcon.php';

    if (isset($_POST['username'])) {
        $username = $_POST['username'];

        // Start a transaction to ensure data integrity
        $conn->begin_transaction();

        // First, get the user's ID
        $stmt = $conn->prepare("SELECT ID FROM user_account WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        // Ensure the user exists before proceeding
        if ($user) {
            $userId = $user['ID'];

            // Delete associated records in the body_health table
            $stmt = $conn->prepare("DELETE FROM body_health WHERE user_id = ?");
            $stmt->bind_param("i", $userId);
            if (!$stmt->execute()) {
                // Rollback if there's an error and exit
                $conn->rollback();
                session_start();
                $_SESSION['error_message'] = "Error deleting associated health records.";
                header('Location: /PRMS/admin/reports.php');
                exit;
            }

            // Delete the user from the user_account table
            $stmt = $conn->prepare("DELETE FROM user_account WHERE username = ?");
            $stmt->bind_param("s", $username);
            if ($stmt->execute()) {
                // Commit the transaction if both delete operations are successful
                $conn->commit();
                session_start();
                $_SESSION['success_message'] = "User deleted successfully.";
                header('Location: /PRMS/admin/reports.php');
                exit;
            } else {
                // Rollback if there's an error and exit
                $conn->rollback();
                session_start();
                $_SESSION['error_message'] = "Error deleting user.";
                header('Location: /PRMS/admin/reports.php');
                exit;
            }
        } else {
            echo "User not found.";
        }
    } else {
        echo "Username not set.";
    }
}



?>
