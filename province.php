<?php
// province.php - The main archive for all provinces
require_once 'includes/db.php';
$page_title = 'Le Province della Calabria - Passione Calabria';
require_once 'includes/header.php';

$provinces = $db->getProvinces();
?>

<div class="bg-white">
    <div class="container mx-auto px-6 py-12 text-center">
        <h1 class="text-4xl font-bold text-calabria-blue">Province della Calabria</h1>
        <p class="mt-3 text-lg text-gray-600">Ogni provincia una scoperta, un viaggio attraverso territori unici e affascinanti.</p>
    </div>
</div>

<div class="bg-gray-100 py-16">
    <div class="container mx-auto px-6">
        <!-- Grid of Provinces -->
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            <?php foreach ($provinces as $province): ?>
            <a href="provincia.php?id=<?php echo $province['id']; ?>" class="group block bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                <div class="relative">
                    <img src="<?php echo htmlspecialchars($province['image']); ?>" alt="<?php echo htmlspecialchars($province['name']); ?>" class="w-full h-64 object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-6">
                        <h2 class="text-3xl font-bold text-white"><?php echo htmlspecialchars($province['name']); ?></h2>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-gray-700 mb-4"><?php echo htmlspecialchars($province['description']); ?></p>
                    <span class="font-bold text-calabria-blue group-hover:underline">Esplora la provincia &rarr;</span>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php
require_once 'includes/footer.php';
?>
