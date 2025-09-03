<?php
// includes/footer.php
?>

</main> <!-- End of main content -->

<footer class="bg-gray-800 text-white mt-16">
    <div class="container mx-auto py-10 px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- About Section -->
            <div class="md:col-span-1">
                <h3 class="text-xl font-bold mb-4">Passione Calabria</h3>
                <p class="text-gray-400">
                    La guida definitiva per scoprire le meraviglie della Calabria: dalle spiagge cristalline ai borghi storici, passando per i sapori unici della nostra terra.
                </p>
            </div>

            <!-- Links Sections -->
            <div class="md:col-span-2 grid grid-cols-2 sm:grid-cols-3 gap-8">
                <div>
                    <h4 class="font-semibold mb-3">Esplora</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="categorie.php" class="hover:text-white transition-colors">Categorie</a></li>
                        <li><a href="province.php" class="hover:text-white transition-colors">Province</a></li>
                        <li><a href="mappa.php" class="hover:text-white transition-colors">Mappa</a></li>
                        <li><a href="articoli.php" class="hover:text-white transition-colors">Articoli</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-3">Collabora</h4>
                    <ul class="space-y-2 text-gray-400">
                        <!-- The description mentions these links in the footer. Using page.php for them. -->
                        <li><a href="page.php?slug=chi-siamo" class="hover:text-white transition-colors">Chi siamo</a></li>
                        <li><a href="page.php?slug=lavora-con-noi" class="hover:text-white transition-colors">Lavora con noi</a></li>
                        <li><a href="page.php?slug=contatti" class="hover:text-white transition-colors">Contatti</a></li>
                        <li><a href="page.php?slug=domande-frequenti" class="hover:text-white transition-colors">Domande frequenti</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-3">Legale</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="privacy-policy.php" class="hover:text-white transition-colors">Privacy Policy</a></li>
                        <li><a href="termini-servizio.php" class="hover:text-white transition-colors">Termini di Servizio</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-700 mt-8 pt-6 flex flex-col md:flex-row justify-between items-center text-sm text-gray-500">
            <p><?php echo "© " . date("Y"); ?> Passione Calabria. Fatto con ♥ in Calabria.</p>
            <div class="flex space-x-4 mt-4 md:mt-0">
                <!-- Social media icons can be added here -->
                <a href="#" class="hover:text-white"><i data-lucide="facebook"></i></a>
                <a href="#" class="hover:text-white"><i data-lucide="instagram"></i></a>
                <a href="#" class="hover:text-white"><i data-lucide="youtube"></i></a>
            </div>
        </div>
    </div>
</footer>

<!-- Script to render Lucide icons -->
<script>
    lucide.createIcons();
</script>

</body>
</html>
