jQuery(document).ready(function($) {
    const searchButton = $('#search-button');
    const searchInput = $('#herb-search');
    const categorySelect = $('#herb-category');
    const resultsDiv = $('#herbs-results');

    searchButton.on('click', performSearch);
    searchInput.on('keypress', function(e) {
        if (e.which === 13) performSearch();
    });

    function performSearch() {
        const searchTerm = searchInput.val();
        const category = categorySelect.val();

        resultsDiv.html('<p>Searching...</p>');

        $.ajax({
            url: ajaxurl,
            data: {
                action: 'search_herbs',
                term: searchTerm,
                category: category
            },
            success: function(response) {
                displayResults(response);
            },
            error: function() {
                resultsDiv.html('<p>Error searching herbs. Please try again.</p>');
            }
        });
    }

    function displayResults(herbs) {
        if (!herbs.length) {
            resultsDiv.html('<p>No herbs found.</p>');
            return;
        }

        let html = '';
        herbs.forEach(herb => {
            html += `
                <div class="herb-card">
                    ${herb.thumbnail ? `<img src="${herb.thumbnail}" alt="${herb.title}">` : ''}
                    <h3>${herb.title}</h3>
                    <div class="herb-meta">
                        <p><strong>Scientific Name:</strong> ${herb.scientific_name || 'N/A'}</p>
                        <p>${herb.excerpt || ''}</p>
                    </div>
                </div>
            `;
        });

        resultsDiv.html(html);
    }

    // Initial search on page load
    performSearch();
});
