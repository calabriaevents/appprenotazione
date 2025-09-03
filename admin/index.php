<?php
// admin/index.php - The Admin Dashboard
require_once '../includes/db.php';
require_once 'includes/header.php';

$stats = $db->getDashboardStats();
$recent_articles = $db->getRecentArticles(5);
?>

<!-- Notification for pending comments -->
<div id="notification-box" class="hidden bg-yellow-200 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6 rounded-md shadow-md" role="alert">
    <div class="flex">
        <div class="py-1"><i data-lucide="alert-triangle" class="w-6 h-6 text-yellow-500 mr-4"></i></div>
        <div>
            <p class="font-bold">Avviso</p>
            <p class="text-sm">Ci sono <span id="pending-comment-count"></span> commenti in attesa di approvazione.</p>
        </div>
    </div>
</div>


<!-- Stats Widgets -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
        <div>
            <p class="text-sm text-gray-500">Articoli Totali</p>
            <p class="text-3xl font-bold text-gray-800"><?php echo $stats['total_articles']; ?></p>
        </div>
        <div class="bg-blue-100 p-3 rounded-full">
            <i data-lucide="file-text" class="w-6 h-6 text-blue-500"></i>
        </div>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
        <div>
            <p class="text-sm text-gray-500">Articoli Pubblicati</p>
            <p class="text-3xl font-bold text-gray-800"><?php echo $stats['published_articles']; ?></p>
        </div>
        <div class="bg-green-100 p-3 rounded-full">
            <i data-lucide="check-circle" class="w-6 h-6 text-green-500"></i>
        </div>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
        <div>
            <p class="text-sm text-gray-500">Visualizzazioni Totali</p>
            <p class="text-3xl font-bold text-gray-800"><?php echo number_format($stats['total_views']); ?></p>
        </div>
        <div class="bg-indigo-100 p-3 rounded-full">
            <i data-lucide="eye" class="w-6 h-6 text-indigo-500"></i>
        </div>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
        <div>
            <p class="text-sm text-gray-500">Commenti in Attesa</p>
            <p class="text-3xl font-bold text-red-500"><?php echo $stats['pending_comments']; ?></p>
        </div>
        <div class="bg-red-100 p-3 rounded-full">
            <i data-lucide="message-square" class="w-6 h-6 text-red-500"></i>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="bg-white p-6 rounded-lg shadow-md mb-8">
    <h2 class="text-xl font-bold text-gray-700 mb-4">Azioni Rapide</h2>
    <div class="flex flex-wrap gap-4">
        <a href="articoli.php?action=new" class="bg-blue-500 text-white font-semibold px-6 py-3 rounded-lg flex items-center gap-2 hover:bg-blue-600 transition-colors">
            <i data-lucide="plus" class="w-5 h-5"></i> Nuovo Articolo
        </a>
        <a href="commenti.php" class="bg-yellow-500 text-white font-semibold px-6 py-3 rounded-lg flex items-center gap-2 hover:bg-yellow-600 transition-colors relative">
            <i data-lucide="message-square" class="w-5 h-5"></i> Commenti
            <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold w-6 h-6 flex items-center justify-center rounded-full"><?php echo $stats['pending_comments']; ?></span>
        </a>
        <a href="database.php?action=backup" class="bg-gray-600 text-white font-semibold px-6 py-3 rounded-lg flex items-center gap-2 hover:bg-gray-700 transition-colors">
            <i data-lucide="database" class="w-5 h-5"></i> Backup DB
        </a>
    </div>
</div>

<!-- Recent Articles -->
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-bold text-gray-700 mb-4">Articoli Recenti</h2>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b bg-gray-50">
                    <th class="p-3">Titolo</th>
                    <th class="p-3">Stato</th>
                    <th class="p-3">Autore</th>
                    <th class="p-3">Azioni</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recent_articles as $article): ?>
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3 font-medium"><?php echo htmlspecialchars($article['title']); ?></td>
                    <td class="p-3">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full <?php echo ($article['status'] === 'Pubblicato') ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'; ?>">
                            <?php echo htmlspecialchars($article['status']); ?>
                        </span>
                    </td>
                    <td class="p-3 text-gray-600"><?php echo htmlspecialchars($article['author']); ?></td>
                    <td class="p-3 flex gap-2">
                        <a href="articoli.php?action=edit&id=<?php echo $article['id']; ?>" class="text-blue-500 hover:underline">Modifica</a>
                        <a href="../articolo.php?slug=<?php echo urlencode($article['slug']); ?>" target="_blank" class="text-gray-500 hover:underline">Visualizza</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
// Mock notification system based on description
const PassioneCalabria = {
    showNotification: function() {
        const pendingCount = <?php echo $stats['pending_comments']; ?>;
        if (pendingCount > 0) {
            const notificationBox = document.getElementById('notification-box');
            document.getElementById('pending-comment-count').textContent = pendingCount;
            notificationBox.classList.remove('hidden');
        }
    }
};

document.addEventListener('DOMContentLoaded', function() {
    PassioneCalabria.showNotification();
});
</script>

<?php
require_once 'includes/footer.php';
?>
