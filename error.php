<?php
// Initialize variables for error messages
$nameError = $emailError = $subjectError = $messageError = "";
$name = $email = $subject = $message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $isValid = true;

    // Validate and sanitize name
    if (empty($_POST['name'])) {
        $nameError = "Name is required.";
        $isValid = false;
    } else {
        $name = htmlspecialchars(trim($_POST['name']));
    }

    // Validate and sanitize email
    if (empty($_POST['email'])) {
        $emailError = "Email is required.";
        $isValid = false;
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $emailError = "Invalid email format.";
        $isValid = false;
    } else {
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    }

    // Validate and sanitize subject
    if (empty($_POST['subject'])) {
        $subjectError = "Subject is required.";
        $isValid = false;
    } else {
        $subject = htmlspecialchars(trim($_POST['subject']));
    }

    // Validate and sanitize message
    if (empty($_POST['message'])) {
        $messageError = "Message is required.";
        $isValid = false;
    } else {
        $message = htmlspecialchars(trim($_POST['message']));
    }

    // If all fields are valid, proceed to insert into database
    if ($isValid) {
        // Database connection details
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "portfolio";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO contact_submissions (name, email, subject, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $subject, $message);

        // Execute query
        if ($stmt->execute()) {
            echo "Thank you! Your message has been sent.";
            $name = $email = $subject = $message = ""; // Clear the form
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close connection
        $stmt->close();
        $conn->close();
    }
}
?>
