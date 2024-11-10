<?php
// Assuming you already have a database connection established

// Retrieve login data
$username = $_POST['username'];
$password = $_POST['password'];

// Prepare and execute the SQL statement
$stmt = $conn->prepare("SELECT passcode FROM Students WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($hashed_password);
    $stmt->fetch();

    // Verify the password
    if (password_verify($password, $hashed_password)) {
        echo "Login successful!";
        // Redirect to a protected page or dashboard
    } else {
        echo "Error: Wrong password.";
    }
} else {
    echo "Error: Username not found.";
}

$stmt->close();
$conn->close();
?>