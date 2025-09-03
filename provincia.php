<?php
// provincia.php - The detail page for a single province
require_once 'includes/db.php';

// Get province ID from URL
$province_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($province_id <= 0) {
    header("Location: province.php");
    exit;
}

$province = $db->getProvinceById($province_id);
if (!$province) {
    header("Location: province.php");
    exit;
}

$cities_in_province = $db->getCitiesByProvinceId($province_id);
$articles_in_province = $db->getAllArticles(); // Mock: getting all articles

$page_title = 'Provincia di ' . htmlspecialchars($province['name']);
require_once 'includes/header.php';
?>

<!-- Add Leaflet.js for the map -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<div class="bg-white">
    <div class="container mx-auto px-6 py-12 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-calabria-blue">
            Provincia di <?php echo htmlspecialchars($province['name']); ?>
        </h1>
        <p class="mt-3 text-lg text-gray-600 max-w-3xl mx-auto"><?php echo htmlspecialchars($province['description']); ?></p>
        <p class="mt-4 text-sm text-gray-500"><?php echo htmlspecialchars($province['article_count']); ?> articoli e luoghi di interesse</p>
    </div>
</div>

<div class="container mx-auto px-6 py-8">
    <!-- Interactive Map Section -->
    <section class="mb-16">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Mappa della Provincia</h2>
        <div id="province-map" class="w-full h-[500px] rounded-lg shadow-lg z-0"></div>
    </section>

    <!-- Articles Gallery Section -->
    <section class="mb-16">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Luoghi da non perdere</h2>
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php foreach (array_slice($articles_in_province, 0, 4) as $article): ?>
            <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:-translate-y-1 transition-transform">
                <a href="articolo.php?slug=<?php echo urlencode($article['slug']); ?>">
                    <img src="<?php echo htmlspecialchars($article['image']); ?>" alt="<?php echo htmlspecialchars($article['title']); ?>" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="font-bold text-calabria-blue"><?php echo htmlspecialchars($article['title']); ?></h3>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Cities Gallery Section -->
    <section>
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Esplora le città</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
            <?php foreach ($cities_in_province as $city): ?>
            <a href="#" class="block bg-gray-100 p-4 rounded-lg shadow-sm text-center hover:bg-calabria-gold hover:text-calabria-blue transition-colors">
                <h3 class="font-semibold"><?php echo htmlspecialchars($city['name']); ?></h3>
            </a>
            <?php endforeach; ?>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const citiesData = <?php echo json_encode(array_values($cities_in_province)); ?>;

    if (citiesData.length > 0) {
        // Initialize the map and set its view to the first city, or calculate bounds
        const map = L.map('province-map').setView([citiesData[0].lat, citiesData[0].lng], 9);

        // Add a tile layer from OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        const markers = [];
        citiesData.forEach(city => {
            const marker = L.marker([city.lat, city.lng]).addTo(map)
                .bindPopup(`<b>${city.name}</b>`);
            markers.push(marker);
        });

        // Fit map to show all markers
        if (markers.length > 0) {
            const group = new L.featureGroup(markers);
            map.fitBounds(group.getBounds().pad(0.2));
        }
    } else {
        // Handle case with no cities
        document.getElementById('province-map').innerHTML = '<div class="flex items-center justify-center h-full bg-gray-200 text-gray-500 rounded-lg"><p>Nessuna città con coordinate disponibili per questa provincia.</p></div>';
    }
});
</script>

<?php
require_once 'includes/footer.php';
?>
