<?php
// articoli.php - The main archive for all articles
require_once 'includes/db.php';
$page_title = 'Tutti gli Articoli - Passione Calabria';
require_once 'includes/header.php';

$articles = $db->getAllArticles();
?>

<div class="bg-gray-100">
    <div class="container mx-auto px-6 py-12">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800">Tutti gli Articoli</h1>
            <p class="mt-3 text-lg text-gray-600">Leggi le nostre guide e lasciati ispirare per il tuo prossimo viaggio in Calabria.</p>
        </div>

        <!-- Grid of Articles -->
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            <?php foreach ($articles as $article): ?>
            <div class="bg-white rounded-xl shadow-md overflow-hidden transform hover:-translate-y-1 transition-transform duration-300 flex flex-col">
                <a href="articolo.php?slug=<?php echo urlencode($article['slug']); ?>" class="block">
                    <img src="<?php echo htmlspecialchars($article['image']); ?>" alt="<?php echo htmlspecialchars($article['title']); ?>" class="w-full h-56 object-cover">
                </a>
                <div class="p-6 flex flex-col flex-grow">
                    <h2 class="text-xl font-bold text-calabria-blue mb-2">
                        <a href="articolo.php?slug=<?php echo urlencode($article['slug']); ?>" class="hover:underline">
                            <?php echo htmlspecialchars($article['title']); ?>
                        </a>
                    </h2>

                    <!-- Star Rating -->
                    <div class="flex items-center my-3">
                        <div class="flex items-center text-yellow-500">
                            <?php
                            $full_stars = floor($article['rating']);
                            $half_star = ($article['rating'] - $full_stars) >= 0.5;
                            $empty_stars = 5 - $full_stars - ($half_star ? 1 : 0);
                            ?>
                            <?php for ($i = 0; $i < $full_stars; $i++): ?>
                                <i data-lucide="star" class="w-5 h-5 fill-current text-giallo-400"></i>
                            <?php endfor; ?>
                            <?php if ($half_star): ?>
                                <!-- This is a simple way to show half stars, more complex SVG would be needed for a true half star -->
                                <i data-lucide="star-half" class="w-5 h-5 fill-current text-giallo-400"></i>
                            <?php endif; ?>
                            <?php for ($i = 0; $i < $empty_stars; $i++): ?>
                                <i data-lucide="star" class="w-5 h-5 fill-current text-gray-300"></i>
                            <?php endfor; ?>
                        </div>
                        <span class="ml-2 text-gray-600 text-sm"><?php echo $article['rating']; ?>/5 (<?php echo $article['votes']; ?> voti)</span>
                    </div>

                    <p class="text-gray-700 text-sm mb-4 flex-grow">
                        <?php echo htmlspecialchars($article['excerpt']); ?>
                    </p>

                    <div class="mt-auto">
                         <a href="articolo.php?slug=<?php echo urlencode($article['slug']); ?>" class="font-bold text-blue-600 hover:text-blue-800 transition-colors">Leggi di più &rarr;</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php
require_once 'includes/footer.php';
?>
