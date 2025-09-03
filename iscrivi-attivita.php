<?php
// iscrivi-attivita.php - Page for businesses to sign up
require_once 'includes/db.php';
$page_title = 'Iscrivi la tua Attività - Passione Calabria';
require_once 'includes/header.php';

$packages = $db->getPackages();
?>

<div class="bg-gray-100">
    <div class="container mx-auto px-6 py-16">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-calabria-blue">Iscrivi la tua Attività</h1>
            <p class="mt-3 text-lg text-gray-600 max-w-3xl mx-auto">
                Unisciti alla nostra rete e dai alla tua attività la visibilità che merita. Raggiungi migliaia di turisti e appassionati della Calabria.
            </p>
        </div>

        <!-- Pricing Packages Grid -->
        <div class="grid lg:grid-cols-3 gap-8 max-w-5xl mx-auto items-start">
            <?php foreach ($packages as $index => $package): ?>
            <div class="bg-white rounded-3xl shadow-xl p-8 transform hover:scale-105 transition-transform duration-300
                <?php echo ($index === 1) ? 'border-4 border-calabria-gold' : ''; // Highlight the middle package ?>">

                <?php if ($index === 1): ?>
                    <div class="text-center -mt-12 mb-6">
                        <span class="bg-calabria-gold text-calabria-blue font-bold tracking-wider uppercase text-sm px-4 py-1 rounded-full">Più Popolare</span>
                    </div>
                <?php endif; ?>

                <div class="text-center">
                    <h2 class="text-2xl font-bold text-calabria-blue"><?php echo htmlspecialchars($package['name']); ?></h2>
                    <p class="text-4xl font-extrabold my-4">
                        <?php echo htmlspecialchars($package['price']); ?>
                    </p>
                </div>

                <ul class="space-y-4 my-8 text-gray-600">
                    <?php foreach ($package['features'] as $feature): ?>
                    <li class="flex items-center gap-3">
                        <i data-lucide="check-circle" class="w-5 h-5 text-green-500"></i>
                        <span><?php echo htmlspecialchars($feature); ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>

                <div class="mt-auto text-center">
                    <a href="registra-business.php?pacchetto_id=<?php echo $package['id']; ?>"
                       class="block w-full text-center rounded-lg py-3 font-bold text-lg
                              <?php echo ($index === 1) ? 'bg-calabria-gold text-calabria-blue hover:bg-yellow-400' : 'bg-calabria-blue text-white hover:bg-opacity-90'; ?>
                              transition-colors">
                        Scegli e Iscriviti
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
