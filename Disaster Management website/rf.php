<?php
// Load the model parameters from the JSON file
$model_file = 'random_forest_model.json';
$model_data = file_get_contents($model_file);

if ($model_data !== false) {
    // Decode the JSON data
    $model_params = json_decode($model_data, true);

    // Establish database connection
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'flood_prediction';

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Fetch data from the MySQL database
    $sql = 'SELECT Rainfall FROM flood_data'; // Adjust this query according to your database structure
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            $rainfall = $row['Rainfall'];

            // Perform prediction using the loaded model
            $prediction = ($rainfall > $model_params['threshold']) ? 'Flood may occur.' : 'No flood expected.';
            // Adjust 'threshold' based on your model parameters saved in the JSON file

            // Display prediction
            echo $prediction . '<br>';
        }
    } else {
        echo 'No data found.';
    }

    $conn->close();
} else {
    echo 'Failed to load the model.';
}
?>
