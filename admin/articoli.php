<?php
// admin/articoli.php - Article Management
require_once '../includes/db.php';
require_once 'includes/header.php';

// In a real app, you would have pagination
$articles = $db->getRecentArticles(50); // Using this method as it has author/status
?>

<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold text-gray-700">Gestione Articoli</h2>
        <a href="articoli.php?action=new" class="bg-blue-500 text-white font-semibold px-4 py-2 rounded-lg flex items-center gap-2 hover:bg-blue-600 transition-colors">
            <i data-lucide="plus" class="w-5 h-5"></i> Crea Nuovo Articolo
        </a>
    </div>

    <!-- Articles Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b bg-gray-50">
                    <th class="p-3">
                        <input type="checkbox" class="rounded">
                    </th>
                    <th class="p-3">Titolo</th>
                    <th class="p-3">Autore</th>
                    <th class="p-3">Categoria</th>
                    <th class="p-3">Stato</th>
                    <th class="p-3">Data</th>
                    <th class="p-3">Azioni</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($articles as $article): ?>
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">
                        <input type="checkbox" class="rounded" name="article_ids[]" value="<?php echo $article['id']; ?>">
                    </td>
                    <td class="p-3 font-medium"><?php echo htmlspecialchars($article['title']); ?></td>
                    <td class="p-3 text-gray-600"><?php echo htmlspecialchars($article['author'] ?? 'N/A'); ?></td>
                    <td class="p-3 text-gray-600">Spiagge</td> <!-- Mock Data -->
                    <td class="p-3">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full <?php echo ($article['status'] === 'Pubblicato') ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'; ?>">
                            <?php echo htmlspecialchars($article['status']); ?>
                        </span>
                    </td>
                    <td class="p-3 text-gray-600">2024-05-10</td> <!-- Mock Data -->
                    <td class="p-3">
                        <div class="flex gap-4">
                            <a href="articoli.php?action=edit&id=<?php echo $article['id']; ?>" class="text-gray-500 hover:text-blue-600" title="Modifica">
                                <i data-lucide="file-pen-line" class="w-5 h-5"></i>
                            </a>
                            <a href="../articolo.php?slug=<?php echo urlencode($article['slug']); ?>" target="_blank" class="text-gray-500 hover:text-green-600" title="Visualizza">
                                <i data-lucide="eye" class="w-5 h-5"></i>
                            </a>
                            <a href="#" class="text-gray-500 hover:text-red-600" title="Elimina">
                                <i data-lucide="trash-2" class="w-5 h-5"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Bulk Actions and Pagination Placeholder -->
    <div class="flex justify-between items-center mt-6">
        <div class="flex gap-2">
            <select class="border-gray-300 rounded-md text-sm">
                <option>Azioni di gruppo</option>
                <option value="delete">Elimina</option>
            </select>
            <button class="bg-gray-200 px-4 py-2 rounded-md text-sm font-semibold hover:bg-gray-300">Applica</button>
        </div>
        <div class="flex gap-1">
            <a href="#" class="px-3 py-1 border rounded-md bg-white hover:bg-gray-100">&laquo;</a>
            <a href="#" class="px-3 py-1 border rounded-md bg-blue-500 text-white">1</a>
            <a href="#" class="px-3 py-1 border rounded-md bg-white hover:bg-gray-100">2</a>
            <a href="#" class="px-3 py-1 border rounded-md bg-white hover:bg-gray-100">&raquo;</a>
        </div>
    </div>
</div>

<?php
require_once 'includes/footer.php';
?>
