
        // Get references to the input field and the container for listings
        const searchInput = document.getElementById('searchbar');
        const listings = document.querySelectorAll('.listing');

        // Function to filter listings based on the search input
        function filterListings() {
          const searchTerm = searchInput.value.toLowerCase();

          // Loop through each listing
          listings.forEach((listing) => {
            const title = listing.querySelector('.name').textContent.toLowerCase();

            if (title.includes(searchTerm)) {
              // Display matching listings
              listing.style.display = 'block';
            } else {
              // Hide non-matching listings
              listing.style.display = 'none';
            }
          });
        }

        // Attach an event listener to the search input
        searchInput.addEventListener('input', filterListings);
