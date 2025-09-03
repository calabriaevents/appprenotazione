<?php
// page.php - Renders all static pages based on a slug
require_once 'includes/db.php';

// Get slug from URL
$slug = isset($_GET['slug']) ? $_GET['slug'] : 'chi-siamo'; // Default to 'chi-siamo'

$page = $db->getPageBySlug($slug);

// If page not found, redirect to homepage
if (!$page) {
    header("Location: index.php");
    exit;
}

$page_title = htmlspecialchars($page['title']) . ' - Passione Calabria';
require_once 'includes/header.php';
?>

<!-- Add Leaflet.js for the map on the contact page -->
<?php if ($slug === 'contatti'): ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<?php endif; ?>

<div class="bg-white py-12">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            <!-- Page Content -->
            <div class="prose lg:prose-lg max-w-none">
                <?php echo $page['content']; // Content is trusted from our mock DB ?>
            </div>
        </div>
    </div>
</div>

<?php if ($slug === 'contatti'): ?>
<div class="bg-gray-100 py-12">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto grid md:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div>
                <h2 class="text-2xl font-bold text-calabria-blue mb-4">Modulo di Contatto</h2>
                <form action="#" method="POST" class="space-y-4">
                    <input type="text" name="name" placeholder="Il tuo Nome" class="w-full p-3 border rounded-md" required>
                    <input type="email" name="email" placeholder="La tua Email" class="w-full p-3 border rounded-md" required>
                    <textarea name="message" rows="6" placeholder="Il tuo messaggio" class="w-full p-3 border rounded-md" required></textarea>
                    <button type="submit" class="bg-calabria-blue text-white font-bold py-3 px-6 rounded-lg hover:bg-opacity-90">Invia Messaggio</button>
                    <p class="text-xs text-gray-500 mt-2">Questo sito è protetto da reCAPTCHA (simulato).</p>
                </form>
            </div>
            <!-- Interactive Map -->
            <div>
                 <h2 class="text-2xl font-bold text-calabria-blue mb-4">Dove Siamo</h2>
                 <div id="contact-map" class="w-full h-80 rounded-lg shadow-md z-0"></div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Coordinates for the main office
    const officeLocation = [38.9093, 16.5876]; // Mock: Catanzaro
    const map = L.map('contact-map').setView(officeLocation, 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker(officeLocation).addTo(map)
        .bindPopup('<b>Passione Calabria</b><br>Il nostro ufficio principale.')
        .openPopup();
});
</script>
<?php endif; ?>


<?php
require_once 'includes/footer.php';
?>
