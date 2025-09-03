<?php
// admin/categorie.php - Category Management
require_once '../includes/db.php';
require_once 'includes/header.php';

$categories = $db->getCategories();
?>

<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold text-gray-700">Gestione Categorie</h2>
        <a href="categorie.php?action=new" class="bg-blue-500 text-white font-semibold px-4 py-2 rounded-lg flex items-center gap-2 hover:bg-blue-600 transition-colors">
            <i data-lucide="plus" class="w-5 h-5"></i> Crea Nuova Categoria
        </a>
    </div>

    <!-- Categories Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b bg-gray-50">
                    <th class="p-3">Nome Categoria</th>
                    <th class="p-3">Descrizione</th>
                    <th class="p-3">N. Articoli</th>
                    <th class="p-3">Azioni</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category): ?>
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3 font-medium"><?php echo htmlspecialchars($category['name']); ?></td>
                    <td class="p-3 text-gray-600 max-w-sm truncate"><?php echo htmlspecialchars($category['description']); ?></td>
                    <td class="p-3 text-gray-600">
                        <a href="articoli.php?category_id=<?php echo $category['id']; ?>" class="text-blue-500 hover:underline">
                            <?php echo htmlspecialchars($category['article_count']); ?>
                        </a>
                    </td>
                    <td class="p-3">
                        <div class="flex gap-4">
                            <a href="categorie.php?action=edit&id=<?php echo $category['id']; ?>" class="text-gray-500 hover:text-blue-600" title="Modifica">
                                <i data-lucide="file-pen-line" class="w-5 h-5"></i>
                            </a>
                            <!--
                                Deletion logic should check if a category has articles.
                                If ($category['article_count'] > 0), the button should be disabled
                                or show a warning modal on click.
                            -->
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
</div>

<?php
require_once 'includes/footer.php';
?>
