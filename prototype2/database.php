<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "weatherapp"; 

// connection creating
$conn = new mysqli($servername, $username, $password);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// checcking for data existing
$query = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$database'";
$result = $conn->query($query);

if ($result->num_rows == 0) {
    // if database does't exist let's make it 
    $createDatabaseQuery = "CREATE DATABASE $database";
    if ($conn->query($createDatabaseQuery) === TRUE) {
        echo "Database created successfully<br>";

        // Table for data
        $conn->select_db($database); /*newly selected data*/

        $createTableQuery = "
            CREATE TABLE weatherdata (
                id INT AUTO_INCREMENT PRIMARY KEY,
                city VARCHAR(255),
                country VARCHAR(255),
                date DATETIME,
                weatherCondition VARCHAR(255),
                weatherIcon VARCHAR(255),
                temperature FLOAT,
                pressure FLOAT,
                windSpeed FLOAT,
                humidity FLOAT
            )";
        
        if ($conn->query($createTableQuery) === TRUE) {
            echo "Table 'weather_data' created successfully";
        } else {
            echo "Error creating table: " . $conn->error;
        }
    } else {
        echo "Error creating database: " . $conn->error;
    }
} else {
    echo "Database already exists";
}

?>