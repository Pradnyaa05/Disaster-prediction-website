<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "flood_prediction";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all data from the flood_prediction table
$sql = "SELECT Month, Rainfall FROM flood_prediction";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $month = $row["Month"];
        $rainfall = $row["Rainfall"];
        // Perform prediction
        $prediction = ($rainfall > 300) ? "Flood may occur in $month." : "No flood expected in $month.";
        // Display prediction
        echo $prediction . "<br>";
    }
} else {
    echo "No data found.";
}

$conn->close();
?>
