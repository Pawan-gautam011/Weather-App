<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Weather Forecaster</title>
    <link rel="shortcut icon" href="assets/favicon.png" type="image/x-icon" />
    <link rel="stylesheet" href="style.css"/>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <script src="weather.js" defer></script>
  </head>
  <body>
    <div class="searchBar">
      <div class="inputContainer">
        <input
          type="text"
          placeholder="Search for cities"
          name="Search"
          id="mySearch"
        />
        <button type="submit"><i class="fa fa-search"></i></button>
        <div id="clear"></div>
      </div>
    </div>
    <div class="line1"></div>
    <div class="loaderflex">
      <div id="loader">
        <img src="assets/loader.gif" alt="loader" width="200px"  class="loaderimage"/>
      </div>
     </div>
    <div class="line2"></div>

    <div class="searchResults"></div>
    <div class="center">
      <div class="container">
        <div class="image">
          <img src="" alt=""  id="image">
        </div>
        <div class="details">
          <div class="flex-name">
          <div id="temperature"></div>
          <div id="description"></div>
          </div>
          <div id="name"></div>
          <hr class="ez">
          <div class="flex-details">
           <div id="wind-speed"></div>
           <div id="humidity"></div>
           <div id="pressure"></div>
          </div>
          <div class="flex">
            <div id="date"></div>
            <div id="time"></div>
          </div>
        </div>
      </div>
    </div>
  <?= include ('7days.php') ?>

  </body>
</html>