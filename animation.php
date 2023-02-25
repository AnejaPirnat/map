<!-- HTML code to display the animation -->
<div id="loading-animation" style="display: block;">
  <img src="animation.php" alt="Loading animation">
</div>

<!-- JavaScript code to hide the animation when API data is loaded -->
<script>
  // Show the loading animation
  document.getElementById('loading-animation').style.display = 'block';

  // Call the API and wait for the data to load
  fetch('your-api-url')
    .then(response => response.json())
    .then(data => {
      // Hide the loading animation
      document.getElementById('loading-animation').style.display = 'none';

      // Process the API data
      // ...
    })
    .catch(error => {
      // Handle API error
      // ...
    });
</script>
