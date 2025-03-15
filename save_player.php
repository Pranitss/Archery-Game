<?php
$servername = "localhost";
$username = "root"; // Change if necessary
$password = ""; // Change if necessary
$dbname = "archery_game"; // Change to your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get player name
$playerName = $_POST["playerName"];

// Handle image upload
if (isset($_FILES["playerImage"])) {
    $imageName = time() . "_" . $_FILES["playerImage"]["name"];
    $imagePath = "uploads/" . $imageName;

    if (move_uploaded_file($_FILES["playerImage"]["tmp_name"], $imagePath)) {
        // Save to database
        $sql = "INSERT INTO players (name, image) VALUES ('$playerName', '$imagePath')";

        if ($conn->query($sql) === TRUE) {
            echo "success";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error uploading file.";
    }
} else {
    echo "No image received.";
}

$conn->close();
?>
