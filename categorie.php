<?php
// categorie.php - The main archive for all categories
require_once 'includes/db.php';
$page_title = 'Tutte le Categorie - Passione Calabria';
require_once 'includes/header.php';

$categories = $db->getCategories();
?>

<div class="bg-white">
    <div class="container mx-auto px-6 py-12">
        <div class="text-center">
            <h1 class="text-4xl font-bold text-calabria-blue">Esplora le Categorie</h1>
            <p class="mt-3 text-lg text-gray-600">Scopri le diverse sfaccettature della Calabria attraverso le nostre guide tematiche.</p>
        </div>
    </div>
</div>

<div class="bg-gray-100 py-16">
    <div class="container mx-auto px-6">
        <!-- Grid of Categories -->
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            <?php foreach ($categories as $category): ?>
            <div class="category-card bg-white rounded-xl shadow-lg overflow-hidden transform hover:-translate-y-2 transition-transform duration-300 ease-in-out">
                <div class="relative">
                    <img src="<?php echo htmlspecialchars($category['image']); ?>" alt="<?php echo htmlspecialchars($category['name']); ?>" class="w-full h-56 object-cover">
                    <div class="absolute bottom-0 left-0 bg-black/50 text-white p-2 text-sm">
                        <span><?php echo htmlspecialchars($category['article_count']); ?> articoli</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-calabria-blue mb-3"><?php echo htmlspecialchars($category['name']); ?></h3>
                    <p class="text-gray-700 mb-6 h-16">
                        <?php echo htmlspecialchars($category['description']); ?>
                    </p>
                    <a href="categoria.php?id=<?php echo $category['id']; ?>" class="inline-block bg-calabria-gold text-calabria-blue font-semibold py-2 px-5 rounded-lg hover:bg-yellow-400 transition-colors">
                        Esplora
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php
require_once 'includes/footer.php';
?>
