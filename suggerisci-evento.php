<?php
// suggerisci-evento.php - Form for users to suggest an event
require_once 'includes/db.php';
$page_title = 'Suggerisci un Evento - Passione Calabria';
require_once 'includes/header.php';

// Fetch data for dropdowns
$provinces = $db->getProvinces();
$categories = $db->getCategories();
?>

<div class="bg-gray-100 py-12">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-xl overflow-hidden">
            <div class="p-8">
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-calabria-blue">Suggerisci un Evento</h1>
                    <p class="mt-2 text-gray-600">Aiutaci a tenere aggiornata la nostra community. Compila il modulo per segnalare un nuovo evento.</p>
                </div>

                <form action="#" method="POST" class="space-y-6">
                    <!-- Anti-spam honeypot field -->
                    <div class="hidden">
                        <label for="contact_me_by_fax_only">Fax</label>
                        <input type="checkbox" name="contact_me_by_fax_only" value="1" tabindex="-1" autocomplete="off">
                    </div>

                    <div>
                        <label for="titolo" class="block text-sm font-medium text-gray-700">Titolo Evento</label>
                        <input type="text" id="titolo" name="titolo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div>
                        <label for="descrizione" class="block text-sm font-medium text-gray-700">Descrizione</label>
                        <textarea id="descrizione" name="descrizione" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required></textarea>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="data_inizio" class="block text-sm font-medium text-gray-700">Data e Ora Inizio</label>
                            <input type="datetime-local" id="data_inizio" name="data_inizio" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div>
                            <label for="data_fine" class="block text-sm font-medium text-gray-700">Data e Ora Fine</label>
                            <input type="datetime-local" id="data_fine" name="data_fine" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <!-- JS logic would pre-populate this field 3 hours after start date if left empty -->
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="provincia" class="block text-sm font-medium text-gray-700">Provincia</label>
                            <select id="provincia" name="provincia" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="">Seleziona una provincia</option>
                                <?php foreach($provinces as $province): ?>
                                <option value="<?php echo $province['id']; ?>"><?php echo htmlspecialchars($province['name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label for="categoria" class="block text-sm font-medium text-gray-700">Categoria</label>
                            <select id="categoria" name="categoria" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="">Seleziona una categoria</option>
                                <?php foreach($categories as $category): ?>
                                <option value="<?php echo $category['id']; ?>"><?php echo htmlspecialchars($category['name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="localita" class="block text-sm font-medium text-gray-700">Località (Indirizzo completo)</label>
                        <input type="text" id="localita" name="localita" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="border-t pt-6">
                        <p class="text-sm text-gray-600 mb-4">Informazioni sull'organizzatore (opzionale)</p>
                        <div class="grid md:grid-cols-3 gap-6">
                             <div>
                                <label for="organizzatore" class="block text-sm font-medium text-gray-700">Nome Organizzatore</label>
                                <input type="text" id="organizzatore" name="organizzatore" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                             <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" id="email" name="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                             <div>
                                <label for="telefono" class="block text-sm font-medium text-gray-700">Telefono</label>
                                <input type="tel" id="telefono" name="telefono" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit" class="bg-calabria-blue text-white font-bold py-3 px-8 rounded-lg hover:bg-opacity-90 transition-colors">
                            Invia Suggerimento
                        </button>
                    </div>
                     <p class="text-xs text-gray-500 text-right">Questo sito è protetto da reCAPTCHA (simulato).</p>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
require_once 'includes/footer.php';
?>
