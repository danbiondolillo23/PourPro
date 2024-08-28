

$(document).ready(function() {

    // Function to toggle between light and dark themes
    function toggleTheme() {

      console.log("Hello");
      // Toggle class on  elements
      $('body').toggleClass('light');
      $('.header-row').toggleClass('light');
      $('.title').toggleClass('light');
      
      // Save current theme in localStorage
      const isLightTheme = $('body').hasClass('light');
      localStorage.setItem('theme', isLightTheme ? 'light' : 'dark');
    }
  
    // Check local for the saved theme preference and apply it on page load
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'light') {
      $('body').addClass('light');
      $('.header-row').addClass('light');
      $('.title').toggleClass('light');

    }
  
    // Event listener for toggle button
    $('#theme-toggle').on('click', toggleTheme);
  
  });