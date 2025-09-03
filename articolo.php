<?php
// articolo.php - The detail page for a single article
require_once 'includes/db.php';

// Get article slug from URL
$article_slug = isset($_GET['slug']) ? $_GET['slug'] : '';

if (empty($article_slug)) {
    header("Location: articoli.php");
    exit;
}

$article = $db->getArticleBySlug($article_slug);

// If article not found, redirect
if (!$article) {
    header("Location: articoli.php");
    exit;
}

$page_title = htmlspecialchars($article['title']) . ' - Passione Calabria';
require_once 'includes/header.php';
?>

<div class="bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <article class="max-w-4xl mx-auto">
            <!-- Article Header -->
            <header class="mb-8">
                <h1 class="text-4xl md:text-5xl font-bold text-calabria-blue leading-tight mb-4">
                    <?php echo htmlspecialchars($article['title']); ?>
                </h1>
                <div class="flex items-center text-gray-500 text-sm">
                    <!-- Star Rating -->
                    <div class="flex items-center text-giallo-400">
                        <?php for ($i = 0; $i < 5; $i++): ?>
                            <i data-lucide="star" class="w-5 h-5 fill-current <?php echo ($i < floor($article['rating'])) ? 'text-giallo-400' : 'text-gray-300'; ?>"></i>
                        <?php endfor; ?>
                        <span class="ml-2 text-gray-600"><?php echo $article['rating']; ?>/5 (<?php echo $article['votes']; ?> voti)</span>
                    </div>
                </div>
            </header>

            <!-- Main Image -->
            <img src="<?php echo htmlspecialchars($article['image']); ?>" alt="<?php echo htmlspecialchars($article['title']); ?>" class="w-full h-auto max-h-[500px] object-cover rounded-xl shadow-lg mb-8">

            <!-- Quick Contacts -->
            <div class="flex flex-wrap justify-center gap-3 my-8">
                <a href="tel:<?php echo htmlspecialchars($article['contacts']['phone']); ?>" class="flex items-center gap-2 bg-gray-200 text-gray-800 px-4 py-2 rounded-full hover:bg-gray-300 transition-colors">
                    <i data-lucide="phone" class="w-4 h-4"></i> Telefono
                </a>
                <a href="https://wa.me/<?php echo htmlspecialchars($article['contacts']['whatsapp']); ?>" target="_blank" class="flex items-center gap-2 bg-green-500 text-white px-4 py-2 rounded-full hover:bg-green-600 transition-colors">
                    <i data-lucide="message-circle" class="w-4 h-4"></i> WhatsApp
                </a>
                <a href="mailto:<?php echo htmlspecialchars($article['contacts']['email']); ?>" class="flex items-center gap-2 bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600 transition-colors">
                    <i data-lucide="mail" class="w-4 h-4"></i> E-mail
                </a>
            </div>

            <!-- Article Body -->
            <div class="prose max-w-none lg:prose-xl text-gray-800">
                <p><?php echo $article['content']; // Using echo with HTML tags from DB ?></p>
            </div>

            <!-- Geographic Link -->
            <div class="my-10 text-center">
                 <a href="<?php echo htmlspecialchars($article['city_link']); ?>" class="text-xl font-bold text-calabria-blue hover:underline">
                    Visita <strong><?php echo htmlspecialchars($article['city_name']); ?></strong> &rarr;
                 </a>
            </div>

            <!-- Image Gallery -->
            <div class="my-12">
                <h3 class="text-2xl font-bold text-gray-800 mb-6">Galleria Immagini</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <?php foreach ($article['gallery'] as $image): ?>
                        <a href="<?php echo htmlspecialchars($image); ?>" data-fancybox="gallery">
                            <img src="<?php echo htmlspecialchars($image); ?>" class="rounded-lg shadow-md hover:opacity-90 transition-opacity">
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Comments Section -->
            <section class="mt-16 border-t pt-10">
                <h3 class="text-2xl font-bold text-gray-800 mb-6">Commenti e Valutazioni</h3>

                <!-- Comment Submission Form -->
                <div class="bg-gray-50 p-6 rounded-lg shadow-inner mb-10">
                    <h4 class="font-bold text-lg mb-4">Lascia la tua recensione</h4>
                    <form action="#" method="POST">
                        <!-- Honeypot field for basic spam protection, hidden from users -->
                        <input type="text" name="honeypot" style="display:none;">

                        <div class="grid md:grid-cols-2 gap-4 mb-4">
                            <input type="text" placeholder="Il tuo nome" class="w-full p-2 border rounded-md" required>
                            <input type="email" placeholder="La tua email (non verrà pubblicata)" class="w-full p-2 border rounded-md" required>
                        </div>
                        <textarea placeholder="Scrivi il tuo commento qui..." rows="5" class="w-full p-2 border rounded-md mb-4" required></textarea>
                        <div class="flex justify-between items-center">
                            <div>
                                <label class="font-semibold">Valutazione:</label>
                                <!-- Star rating input would require JS, so this is a placeholder -->
                                <div class="flex gap-1 text-2xl text-gray-400">
                                    <i data-lucide="star" class="cursor-pointer hover:text-giallo-400"></i>
                                    <i data-lucide="star" class="cursor-pointer hover:text-giallo-400"></i>
                                    <i data-lucide="star" class="cursor-pointer hover:text-giallo-400"></i>
                                    <i data-lucide="star" class="cursor-pointer hover:text-giallo-400"></i>
                                    <i data-lucide="star" class="cursor-pointer hover:text-giallo-400"></i>
                                </div>
                            </div>
                            <button type="submit" class="bg-calabria-blue text-white font-bold px-6 py-3 rounded-lg hover:bg-opacity-90">Invia</button>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Questo sito è protetto da reCAPTCHA (simulato).</p>
                    </form>
                </div>

                <!-- List of Approved Comments -->
                <div class="space-y-6">
                    <?php foreach ($article['comments'] as $comment): ?>
                    <div class="flex gap-4">
                        <div class="bg-gray-200 w-12 h-12 rounded-full flex items-center justify-center">
                            <i data-lucide="user" class="w-6 h-6 text-gray-500"></i>
                        </div>
                        <div>
                            <p class="font-bold"><?php echo htmlspecialchars($comment['author']); ?></p>
                            <div class="flex items-center text-giallo-400 my-1">
                                <?php for ($i = 0; $i < 5; $i++): ?>
                                    <i data-lucide="star" class="w-4 h-4 fill-current <?php echo ($i < $comment['rating']) ? 'text-giallo-400' : 'text-gray-300'; ?>"></i>
                                <?php endfor; ?>
                            </div>
                            <p class="text-gray-700"><?php echo htmlspecialchars($comment['comment']); ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

            </section>
        </article>
    </div>
</div>

<?php
require_once 'includes/footer.php';
?>
