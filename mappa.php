<?php
// mappa.php - The main interactive map of Calabria
require_once 'includes/db.php';
$page_title = 'Mappa Interattiva della Calabria';
require_once 'includes/header.php';

// Fetch all cities with coordinates from the DB
$all_cities = $db->getCities();
?>

<!-- Add Leaflet.js for the map -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<div class="bg-white">
    <div class="container mx-auto px-6 py-12 text-center">
        <h1 class="text-4xl font-bold text-calabria-blue">Mappa della Calabria</h1>
        <p class="mt-3 text-lg text-gray-600">Esplora visivamente i luoghi più affascinanti della regione.</p>
    </div>
</div>

<div class="container mx-auto px-6 py-8">
    <div id="full-calabria-map" class="w-full h-[600px] rounded-lg shadow-lg z-0"></div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const citiesData = <?php echo json_encode(array_values($all_cities)); ?>;

    if (citiesData.length > 0) {
        // Initialize the map, centered on Calabria
        const map = L.map('full-calabria-map').setView([39.0, 16.5], 8); // Centered on Calabria

        // Add a tile layer from OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Add markers for each city
        citiesData.forEach(city => {
            L.marker([city.lat, city.lng]).addTo(map)
                .bindPopup(`<b>${city.name}</b><br><a href='${city.link}'>Scopri di più</a>`);
        });

    } else {
        document.getElementById('full-calabria-map').innerHTML = '<div class="flex items-center justify-center h-full bg-gray-200 text-gray-500 rounded-lg"><p>Nessun dato geografico disponibile.</p></div>';
    }
});
</script>

<?php
require_once 'includes/footer.php';
?>
