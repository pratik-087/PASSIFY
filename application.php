<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $age = htmlspecialchars($_POST['age']);
    $gender = htmlspecialchars($_POST['gender']);
    $source_add = htmlspecialchars($_POST['source_add']);
    $destination_add = htmlspecialchars($_POST['destination_add']);
    $pass_type = htmlspecialchars($_POST['pass_type']);

    // Basic validation
    if (empty($name) || empty($phone) || empty($email) || empty($age) || empty($gender) || empty($source_add) || empty($destination_add) || empty($pass_type)) {
        echo "<h2 style='color: red;'>All fields are required. Please go back and fill out the form completely.</h2>";
        exit;
    }

    // Database connection
    $servername = "localhost"; // Update with your server details
    $username = "root";       // Update with your database username
    $password = "";          // Update with your database password
    $dbname = "passify_db";  // Update with your database name

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    $conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully!";


    // Insert data into the database
    $sql = "INSERT INTO applications (name, phone, email, age, gender, source_add, destination_add, pass_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssiisss", $name, $phone, $email, $age, $gender, $source_add, $destination_add, $pass_type);

    if ($stmt->execute()) {
        echo "<h1>Application Submitted Successfully</h1>";
        echo "<p><strong>Name:</strong> $name</p>";
        echo "<p><strong>Phone:</strong> $phone</p>";
        echo "<p><strong>Email:</strong> $email</p>";
        echo "<p><strong>Age:</strong> $age</p>";
        echo "<p><strong>Gender:</strong> $gender</p>";
        echo "<p><strong>Source Address:</strong> $source_add</p>";
        echo "<p><strong>Destination Address:</strong> $destination_add</p>";
        echo "<p><strong>Pass Type:</strong> $pass_type</p>";
    } else {
        echo "<h2 style='color: red;'>Error: " . $stmt->error . "</h2>";
    }

    $stmt->close();
    $conn->close();
} else {
    // If the script is accessed directly without submitting the form
    echo "<h2 style='color: red;'>Invalid Request. Please submit the form first.</h2>";
}
?>
