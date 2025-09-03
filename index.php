<?php
// index.php - The Homepage
require_once 'includes/db.php';
$page_title = 'Passione Calabria - Scopri il cuore del Mediterraneo';
require_once 'includes/header.php';

// Mock settings for app links visibility
$settings = [
    'app_store_link' => 'https://apple.com',
    'play_store_link' => 'https://play.google.com'
];
?>

<!-- Hero Section -->
<div class="relative h-[60vh] min-h-[400px] bg-cover bg-center" style="background-image: url('https://placehold.co/1920x1080/003366/FFFFFF?text=Benvenuti+in+Calabria');">
    <div class="absolute inset-0 bg-black/50 flex items-center justify-center text-center">
        <div class="text-white px-4">
            <h1 class="text-4xl md:text-6xl font-bold mb-4 fade-in-up">Scopri la Calabria</h1>
            <p class="text-lg md:text-xl max-w-3xl mx-auto mb-8 fade-in-up" style="animation-delay: 0.2s;">
                Immergiti nella bellezza della Calabria, con le sue spiagge idilliache, i borghi medievali, e panorami mozzafiato.
            </p>
            <div class="flex justify-center gap-4 fade-in-up" style="animation-delay: 0.4s;">
                <a href="categorie.php" class="bg-calabria-gold text-calabria-blue font-bold py-3 px-6 rounded-lg hover:bg-yellow-400 transition-transform hover:scale-105">Scopri di più</a>
                <a href="mappa.php" class="bg-white/90 text-gray-800 font-bold py-3 px-6 rounded-lg hover:bg-white transition-transform hover:scale-105">Vedi la Mappa</a>
            </div>
        </div>
    </div>
</div>

<!-- Search Filter Section -->
<div class="bg-white -mt-12 relative shadow-lg rounded-lg container mx-auto p-6">
    <div class="grid md:grid-cols-3 gap-4 items-end">
        <div>
            <label for="search_what" class="block text-sm font-medium text-gray-700">Cosa stai cercando?</label>
            <input type="text" id="search_what" placeholder="Es. spiaggia, museo, ristorante..." class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-calabria-blue focus:border-calabria-blue">
        </div>
        <div>
            <label for="search_province" class="block text-sm font-medium text-gray-700">Provincia</label>
            <input type="text" id="search_province" placeholder="Es. Cosenza" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-calabria-blue focus:border-calabria-blue">
        </div>
        <button class="w-full md:w-auto bg-calabria-blue text-white font-bold py-3 px-6 rounded-lg hover:bg-opacity-90">Cerca</button>
    </div>
</div>

<!-- Event and App Section -->
<div class="container mx-auto py-12 px-6 text-center">
    <a href="suggerisci-evento.php" class="bg-red-500 text-white font-bold py-3 px-8 rounded-lg hover:bg-red-600 transition-transform hover:scale-105 inline-block">
        Suggerisci un Evento
    </a>
    <?php if (!empty($settings['app_store_link']) && !empty($settings['play_store_link'])): ?>
    <div class="mt-8 flex justify-center items-center gap-4">
        <a href="#" class="text-gray-700 font-semibold">Scopri la nostra App:</a>
        <a href="<?php echo htmlspecialchars($settings['app_store_link']); ?>" target="_blank" class="bg-black text-white py-2 px-4 rounded-lg flex items-center gap-2 hover:bg-gray-800">
            <i data-lucide="apple" class="w-5 h-5"></i> App Store
        </a>
        <a href="<?php echo htmlspecialchars($settings['play_store_link']); ?>" target="_blank" class="bg-black text-white py-2 px-4 rounded-lg flex items-center gap-2 hover:bg-gray-800">
            <i data-lucide="play" class="w-5 h-5"></i> Google Play
        </a>
    </div>
    <?php endif; ?>
</div>

<!-- Explore Categories Section -->
<section class="bg-gray-50 py-16">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-2">Esplora per Categoria</h2>
        <p class="text-center text-gray-600 mb-10">Trova ciò che ti appassiona di più.</p>
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php
            $categories = $db->getCategories();
            foreach ($categories as $category):
            ?>
            <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:-translate-y-2 transition-transform duration-300">
                <img src="<?php echo htmlspecialchars($category['image']); ?>" alt="<?php echo htmlspecialchars($category['name']); ?>" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-calabria-blue mb-2"><?php echo htmlspecialchars($category['name']); ?></h3>
                    <p class="text-gray-600 text-sm mb-4"><?php echo htmlspecialchars($category['description']); ?></p>
                    <a href="categoria.php?id=<?php echo $category['id']; ?>" class="font-bold text-calabria-blue hover:underline">Esplora Categoria &rarr;</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-12">
            <a href="categorie.php" class="bg-calabria-blue text-white font-bold py-3 px-8 rounded-lg hover:bg-opacity-90">Vedi tutte le categorie</a>
        </div>
    </div>
</section>

<!-- Explore Provinces Section -->
<section class="py-16">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-2">Esplora per Provincia</h2>
        <p class="text-center text-gray-600 mb-10">Scopri le diverse anime della Calabria.</p>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
             <?php
            $provinces = $db->getProvinces();
            foreach ($provinces as $province):
            ?>
            <div class="bg-white rounded-lg shadow-lg overflow-hidden group">
                <div class="relative">
                    <img src="<?php echo htmlspecialchars($province['image']); ?>" alt="<?php echo htmlspecialchars($province['name']); ?>" class="w-full h-64 object-cover">
                    <div class="absolute inset-0 bg-black/40 flex items-end p-6">
                        <div>
                            <h3 class="text-2xl font-bold text-white"><?php echo htmlspecialchars($province['name']); ?></h3>
                            <span class="text-yellow-300 text-sm"><?php echo $province['article_count']; ?> articoli</span>
                        </div>
                    </div>
                </div>
                <a href="provincia.php?id=<?php echo $province['id']; ?>" class="block bg-calabria-gold text-calabria-blue text-center font-bold py-3 hover:bg-yellow-400 transition-colors">
                    Esplora la Provincia
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="bg-calabria-blue text-white">
    <div class="container mx-auto px-6 py-16 text-center">
        <h2 class="text-3xl font-bold mb-3">Vuoi far conoscere la tua Calabria?</h2>
        <p class="text-lg text-yellow-200 mb-8 max-w-2xl mx-auto">
            Suggerisci un luogo o un'attività che ami e aiutaci a creare una guida completa e autentica, fatta da chi vive la Calabria ogni giorno.
        </p>
        <a href="suggerisci-evento.php" class="bg-white text-calabria-blue font-bold py-3 px-8 rounded-lg hover:bg-gray-200 transition-transform hover:scale-105">
            Suggerisci un Luogo
        </a>
    </div>
</section>


<?php
require_once 'includes/footer.php';
?>
