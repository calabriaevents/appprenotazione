<?php
// admin/includes/header.php
session_start(); // Start session for admin login status (simulated)

// Simulate a logged-in admin
$_SESSION['admin_logged_in'] = true;
$_SESSION['admin_user'] = 'JulesAdmin';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // In a real app, redirect to a login page
    // header('Location: login.php');
    // exit;
    echo "Access Denied. Please log in.";
    exit;
}

$admin_pages = [
    'index.php' => ['icon' => 'home', 'title' => 'Dashboard'],
    'articoli.php' => ['icon' => 'file-text', 'title' => 'Articoli'],
    'categorie.php' => ['icon' => 'list', 'title' => 'Categorie'],
    'province.php' => ['icon' => 'map', 'title' => 'Territorio'],
    'commenti.php' => ['icon' => 'message-square', 'title' => 'Commenti'],
    'business.php' => ['icon' => 'briefcase', 'title' => 'Business'],
    'abbonamenti.php' => ['icon' => 'credit-card', 'title' => 'Abbonamenti'],
    'utenti.php' => ['icon' => 'users', 'title' => 'Utenti'],
    'pagine-statiche.php' => ['icon' => 'file', 'title' => 'Pagine Statiche'],
    'impostazioni.php' => ['icon' => 'settings', 'title' => 'Impostazioni'],
    'database.php' => ['icon' => 'database', 'title' => 'Database'],
];

// Get the current page name
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Passione Calabria</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-100">

<div class="flex h-screen bg-gray-200 font-sans">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white flex-shrink-0 flex flex-col">
        <div class="p-6 text-2xl font-bold border-b border-gray-700 text-center">
            <a href="index.php">Passione Calabria</a>
        </div>
        <nav class="p-4 flex-grow">
            <ul class="space-y-2">
                <?php foreach ($admin_pages as $page_file => $page_data): ?>
                <li>
                    <a href="<?php echo $page_file; ?>"
                       class="flex items-center gap-3 px-4 py-2 rounded-lg transition-colors
                              <?php echo ($current_page === $page_file) ? 'bg-calabria-blue text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white'; ?>">
                        <i data-lucide="<?php echo $page_data['icon']; ?>" class="w-5 h-5"></i>
                        <span><?php echo $page_data['title']; ?></span>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </nav>
        <div class="p-4 border-t border-gray-700">
             <a href="../index.php" class="flex items-center gap-3 px-4 py-2 rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white">
                <i data-lucide="arrow-left-circle" class="w-5 h-5"></i>
                <span>Torna al Sito</span>
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Top bar -->
        <header class="bg-white shadow-md p-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">
                <?php echo $admin_pages[$current_page]['title'] ?? 'Admin'; ?>
            </h1>
            <div>
                <span class="text-gray-600">Benvenuto, <?php echo $_SESSION['admin_user']; ?></span>
                <a href="#" class="ml-4 text-sm text-red-500 hover:underline">Logout</a>
            </div>
        </header>

        <!-- Page content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
            <div class="container mx-auto">
                <!-- Content for each page will go here -->
