window.addEventListener("DOMContentLoaded", function () {
    const apiKey = "a9371c39d13d79c281a940956e8c3f34";
    const searchResultContainer = document.getElementById("searchResults");
    const loader = document.getElementById('loader');
    const clear = document.getElementById('clear');
    const cityNameInput = document.getElementById("cityName");
    const submitBtn = document.getElementById("searchBtn");
    let cityName = '';
  
  // Dark mode toggle
  const darkModeToggle = document.getElementById("darkModeToggle");
  const body = document.body;

  darkModeToggle.addEventListener("change", function () {
    body.classList.toggle("dark-mode");
  });

    async function fetchWeatherData(cityName) {
      try {
        searchResultContainer.innerHTML = '';
        loader.style.display = 'block';
  
    
        const response = await fetch(
          `https://api.openweathermap.org/data/2.5/weather?q=${cityName}&appid=${apiKey}`
        );
  
       
        if (response.ok) {
          const data = await response.json();
  
         
          const resultContainer = document.createElement("div");
          resultContainer.classList.add("result-container");
  
          // City name
          const cityElement = document.createElement("h2");
          cityElement.textContent = data.name;
  
          // Country
          const countryElement = document.createElement("p");
          countryElement.textContent = `Country: ${data.sys.country}`;
  
          // Weather description
          const weatherDescElement = document.createElement("p");
          weatherDescElement.textContent = `Weather Description: ${data.weather[0].description}`;
  
          // Weather icon
          const weatherIconElement = document.createElement("img");
          weatherIconElement.src = `https://openweathermap.org/img/w/${data.weather[0].icon}.png`;
          weatherIconElement.alt = "Weather Icon";
  
          // Temperature
          const tempElement = document.createElement("p");
          tempElement.textContent = `Temperature: ${kelvinToCelsius(data.main.temp)}°C`;
  
          // Pressure
          const pressureElement = document.createElement("p");
          pressureElement.textContent = `Pressure: ${data.main.pressure} hPa`;
  
          // Wind speed
          const windSpeedElement = document.createElement("p");
          windSpeedElement.textContent = `Wind Speed: ${data.wind.speed} m/s`;
  
          // Humidity
          const humidityElement = document.createElement("p");
          humidityElement.textContent = `Humidity: ${data.main.humidity}%`;
  
          // Date
          const dateElement = document.createElement("p");
          dateElement.textContent = `Date: ${formatDateTime(data.dt)}`;
  
          // Time
          const timeElement = document.createElement("p");
          timeElement.textContent = `Time: ${convertTime(data.dt)}`;
  
          // Append all elements to result container
          resultContainer.appendChild(cityElement);
          resultContainer.appendChild(countryElement);
          resultContainer.appendChild(weatherDescElement);
          resultContainer.appendChild(weatherIconElement);
          resultContainer.appendChild(tempElement);
          resultContainer.appendChild(pressureElement);
          resultContainer.appendChild(windSpeedElement);
          resultContainer.appendChild(humidityElement);
          resultContainer.appendChild(dateElement);
          resultContainer.appendChild(timeElement);
  
          // Append the result container to the searchResultContainer
          searchResultContainer.appendChild(resultContainer);
  
          // Hide the loader
          loader.style.display = 'none';
        } else {
          throw new Error("Sorry City NOt found");
        }
      } catch (error) {
        console.error(error);
        const errorMessage = document.createElement("p");
        errorMessage.textContent = "Sorry city not found";
        searchResultContainer.appendChild(errorMessage);
  
        // Hide the loader
        loader.style.display = 'none';
      }
    }
  
    // Function to convert temperature from Kelvin to Celsius
    function kelvinToCelsius(temp) {
      return (temp - 273.15).toFixed(2);
    }
  
    // Function to format date and time from timestamp
    function formatDateTime(timestamp) {
      const date = new Date(timestamp * 1000);
      return date.toLocaleDateString();
    }
  
    // Function to convert timestamp to time
    function convertTime(timestamp) {
      const time = new Date(timestamp * 1000);
      return time.toLocaleTimeString();
    }
  
    // Event listener for search button click
    submitBtn.addEventListener("click", function () {
      cityName = cityNameInput.value;
      fetchWeatherData(cityName);
    });
  
    // Event listener for Enter key press in the input field
    cityNameInput.addEventListener('keyup', function(event){
      if (event.keyCode === 13){
        cityName = cityNameInput.value;
        fetchWeatherData(cityName);
      }
    });
  
    // Event listener for clear button click
    clear.addEventListener('click', function(){ 
      cityNameInput.value = '';
      clear.style.display = 'none';
    });
  
    // Event listener for input field value change
    cityNameInput.addEventListener('input', function() {
      cityName = cityNameInput.value;
      if (cityName.length === 0) {
        clear.style.display = 'none';
      } else {
        clear.style.display = 'block';
      }
    });
  
    fetchWeatherData('Macclesfield');
  });