<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database configuration
$servername = "localhost"; // Change if necessary
$username = "root"; // Replace with your database username
$password = "Ojesh@123"; // Replace with your database password
$dbname = "StudentAttendanceSystem"; // Use the correct database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the data from the POST request
    $studentname = $_POST['student_name'] ?? ''; // Ensure the key matches your form data
    $email = $_POST['email'] ?? '';
    $collegeid = $_POST['college_id'] ?? '';
      // Debugging output
      echo "Received data: <br>";
      echo "Student Name: '$studentname'<br>";
      echo "Email: '$email'<br>";
      echo "College ID: '$collegeid'<br>";

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO Students (student_name, email, college_id) VALUES (?, ?, ?)");
    
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("sss", $studentname, $email, $collegeid);

     // Execute the statement
     if ($stmt->execute()) {
        echo "Success: Account created!";
    } else {
        echo "Execute failed: " . $stmt->error; // Change die() to echo to see the error
    }


    // Close the statement
    $stmt->close();
} else {
    echo "Invalid request method.";
}

// Close the connection
$conn->close();
?>