<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Weather Forecaster</title>
    <link rel="shortcut icon" href="assets/favicon.png" type="image/x-icon" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="7days.css">
</head>
<body>        
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "weatherapp";

    //  connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    echo "<h1 class='top'>Past 7 days weather</h1>";
    // Calculate the date 7 days ago from today
    $sevenDaysAgo = date('Y-m-d', strtotime('-6 days'));

    // SQL query to select one data entry for each day in the past 7 days
    $sql = "SELECT city, country, date, weatherIcon, temperature
            FROM weatherdata
            WHERE city = 'Macclesfield' AND date >= '$sevenDaysAgo'
            GROUP BY date";

    $result = $conn->query($sql);

    // Generate HTML divs
    if ($result->num_rows > 0) {
        echo "<div class='cityWeatherContainer2'>";
        while ($row = $result->fetch_assoc()) {
            // Convert the date string to a DateTime object
            $date = new DateTime($row["date"]);
            // Get the day of the week
            $dayOfWeek = $date->format('l');
            
            echo "<div class='cityWeather2'>
                <div class='city2'>" . $row["city"] . ", " . $row["country"] . "</div>
                <div class='dayOfWeek2'>" . $dayOfWeek . "</div>
                <img class='weatherIcon2' src='http://openweathermap.org/img/w/" . $row["weatherIcon"] . ".png' alt='Weather Icon' />
                <div class='temperature2'>" . $row["temperature"] . " &#8451;</div>
                <div class='date2'>" . $row["date"] . "</div>
              </div>";
        }
        echo "</div>";
    } else {
        echo "No data available.";
    }

    $conn->close();
    ?>
</body>
</html>