
            document.getElementById('searchForm').addEventListener('submit', function(event) {
                // Empêcher le comportement par défaut du formulaire de rechargement de la page
                event.preventDefault();
                let searchTerm = document.getElementById('searchInput').value.trim().toLowerCase();
                // Contenu pour Gardening
                let gardeningCards = document.querySelectorAll('.cardContainerX:nth-of-type(1) .cardX');
                gardeningCards.forEach(function(card) {
                    if (card.textContent.toLowerCase().includes(searchTerm)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
                // Contenu pour Pet Care
                let petCareCards = document.querySelectorAll('.cardContainerX:nth-of-type(2) .cardX');
                petCareCards.forEach(function(card) {
                    if (card.textContent.toLowerCase().includes(searchTerm)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
                // Contenu pour Bricolage
                let bricolageCards = document.querySelectorAll('.cardContainerX:nth-of-type(3) .cardX');
                bricolageCards.forEach(function(card) {
                    if (card.textContent.toLowerCase().includes(searchTerm)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });