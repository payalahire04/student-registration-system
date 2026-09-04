<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "campusconnect";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$fullname  = $_POST['fullname'];
$studentid = $_POST['studentid'];
$email     = $_POST['email'];
$college   = $_POST['college'];
$location  = $_POST['location'];
$event     = $_POST['event'];
$pass      = $_POST['password'];

$hashed_password = password_hash($pass, PASSWORD_DEFAULT);

$sql = "INSERT INTO student1
        (fullname, studentid, email, college, location, event, password)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "sssssss",
    $fullname,
    $studentid,
    $email,
    $college,
    $location,
    $event,
    $hashed_password
);

if (mysqli_stmt_execute($stmt)) {

    echo "<h2>Registration Successful!</h2>";
    echo "<p>Your registration has been completed successfully.</p>";
    echo "<a href='login.html'>Go to Login</a>";

} else {

    echo "<h2>Registration Failed</h2>";
    echo "<p>" . mysqli_error($conn) . "</p>";
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

?>