<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "campusconnect";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$username = $_POST['username'];
$pass     = $_POST['password'];

$sql = "SELECT * FROM student1
        WHERE email = ? OR studentid = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "ss",
    $username,
    $username
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 1) {

    $student = mysqli_fetch_assoc($result);

    if (password_verify($pass, $student['password'])) {

        echo "<h2>Welcome to CampusConnect!</h2>";

    } else {

        echo "<h2>Invalid username or password.</h2>";
    }

} else {

    echo "<h2>Invalid username or password.</h2>";
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

?>