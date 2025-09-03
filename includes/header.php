<?php
// includes/header.php

// In a real application, you might have logic here to determine the page title,
// handle sessions, etc. For now, we'll keep it simple.
$page_title = "Passione Calabria"; // Default title
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page_title); ?></title>

    <!-- Tailwind CSS via Play CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom CSS Files -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/translation-system.css">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <script>
        // Customizations for Tailwind can be put here if needed
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'giallo-200': '#fde68a',
                        'giallo-400': '#facc15',
                        'calabria-blue': '#003366',
                        'calabria-gold': '#FFD700',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100 font-sans">

<header class="sticky top-0 z-50">
    <!-- Top Bar -->
    <div class="bg-black/20 backdrop-blur-sm text-white text-sm py-1 px-4 md:px-6">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Left Side -->
            <div class="flex items-center gap-2">
                <i data-lucide="map-pin" class="w-4 h-4"></i>
                <span>Scopri la Calabria</span>
            </div>

            <!-- Center -->
            <div class="hidden md:flex items-center gap-1">
                <span>Lingua:</span>
                <span class="font-bold text-giallo-200">Italiano</span>
            </div>

            <!-- Right Side -->
            <div class="hidden lg:block">
                <span>Benvenuto in Passione Calabria</span>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <nav class="bg-white shadow-md py-3 px-4 md:px-6">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Logo -->
            <a href="index.php" class="text-2xl font-bold text-calabria-blue">
                Passione Calabria
            </a>

            <!-- Main Menu -->
            <ul class="hidden lg:flex items-center gap-6 text-gray-700">
                <li><a href="index.php" class="hover:text-calabria-blue transition-colors">Home</a></li>
                <li><a href="categorie.php" class="hover:text-calabria-blue transition-colors">Categorie</a></li>
                <li><a href="province.php" class="hover:text-calabria-blue transition-colors">Provincia</a></li>
                <li><a href="mappa.php" class="hover:text-calabria-blue transition-colors">Mappa</a></li>
            </ul>

            <!-- Action Buttons -->
            <div class="flex items-center gap-3">
                <a href="iscrivi-attivita.php" class="bg-calabria-gold text-calabria-blue font-semibold px-4 py-2 rounded-lg hover:bg-yellow-400 transition-colors text-sm">
                    Iscrivi la tua attività
                </a>
                <a href="admin/index.php" class="bg-gray-200 text-gray-800 font-semibold px-4 py-2 rounded-lg hover:bg-gray-300 transition-colors text-sm">
                    Admin
                </a>
                <!-- Mobile Menu Button -->
                <button class="lg:hidden text-gray-700">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>
            </div>
        </div>
    </nav>
</header>

<main>
    <!-- Page content will be injected here -->
