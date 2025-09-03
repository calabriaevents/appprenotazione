<?php
// categoria.php - The detail page for a single category
require_once 'includes/db.php';

// Get category ID from URL, with basic validation
$category_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($category_id <= 0) {
    // A more robust site would have a proper 404 page
    header("Location: categorie.php");
    exit;
}

$category = $db->getCategoryById($category_id);
$all_articles = $db->getAllArticles(); // In a real app, this would be a filtered query
$other_categories = array_filter($db->getCategories(), function($c) use ($category_id) {
    return $c['id'] != $category_id;
});


// If category not found, redirect
if (!$category) {
    header("Location: categorie.php");
    exit;
}

$page_title = 'Categoria: ' . htmlspecialchars($category['name']) . ' - Passione Calabria';
require_once 'includes/header.php';
?>

<!-- Category Header -->
<div class="relative bg-cover bg-center h-80" style="background-image: url('<?php echo htmlspecialchars($category['header_image']); ?>');">
    <div class="absolute inset-0 bg-black/60 flex flex-col items-center justify-center text-center text-white p-4">
        <h1 class="text-5xl font-bold"><?php echo htmlspecialchars($category['name']); ?></h1>
        <p class="mt-4 max-w-2xl text-lg"><?php echo htmlspecialchars($category['description']); ?></p>
    </div>
</div>

<div class="bg-gray-100 py-16">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-gray-800 mb-8">Articoli in questa categoria</h2>

        <!-- Grid of Articles -->
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            <?php foreach ($all_articles as $article): ?>
            <div class="bg-white rounded-xl shadow-md overflow-hidden transform hover:-translate-y-1 transition-transform duration-300">
                <a href="articolo.php?slug=<?php echo urlencode($article['slug']); ?>" class="block">
                    <img src="<?php echo htmlspecialchars($article['image']); ?>" alt="<?php echo htmlspecialchars($article['title']); ?>" class="w-full h-56 object-cover">
                </a>
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-calabria-blue mb-2 h-14">
                        <a href="articolo.php?slug=<?php echo urlencode($article['slug']); ?>" class="hover:underline">
                            <?php echo htmlspecialchars($article['title']); ?>
                        </a>
                    </h3>
                    <!-- Star Rating -->
                    <div class="flex items-center my-3 text-yellow-500">
                        <?php for ($i = 0; $i < 5; $i++): ?>
                            <i data-lucide="star" class="w-5 h-5 fill-current <?php echo ($i < floor($article['rating'])) ? 'text-giallo-400' : 'text-gray-300'; ?>"></i>
                        <?php endfor; ?>
                        <span class="ml-2 text-gray-600 text-sm"><?php echo $article['rating']; ?>/5 (<?php echo $article['votes']; ?> voti)</span>
                    </div>
                    <p class="text-gray-700 text-sm mb-4 h-20">
                        <?php echo htmlspecialchars($article['excerpt']); ?>
                    </p>
                    <a href="articolo.php?slug=<?php echo urlencode($article['slug']); ?>" class="font-bold text-blue-600 hover:underline">Leggi di più &rarr;</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-12">
            <a href="categorie.php" class="bg-gray-300 text-gray-800 font-bold py-3 px-8 rounded-lg hover:bg-gray-400 transition-colors">
                &larr; Torna a tutte le categorie
            </a>
        </div>
    </div>
</div>


<!-- Explore Other Categories Section -->
<section class="bg-white py-16">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-10">Esplora altre categorie</h2>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach (array_slice($other_categories, 0, 3) as $other_cat): ?>
            <div class="bg-gray-50 rounded-lg shadow-lg overflow-hidden text-center p-6 transform hover:scale-105 transition-transform duration-300">
                <h3 class="text-xl font-bold text-calabria-blue mb-2"><?php echo htmlspecialchars($other_cat['name']); ?></h3>
                <p class="text-gray-600 text-sm mb-4"><?php echo htmlspecialchars($other_cat['description']); ?></p>
                <a href="categoria.php?id=<?php echo $other_cat['id']; ?>" class="font-bold text-calabria-blue hover:underline">Esplora &rarr;</a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
require_once 'includes/footer.php';
?>
