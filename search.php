<?php
/**
 * search.php
 *
 * API endpoint for handling search and autocomplete requests.
 * This file is not meant to be accessed directly by users.
 */

// Set the content type to JSON
header('Content-Type: application/json');

// --- Security: Rate Limiting (Conceptual) ---
// In a real application, you would implement a robust rate-limiting mechanism
// to prevent abuse and DoS attacks. This could be based on IP address.
//
// Example logic:
// $ip = $_SERVER['REMOTE_ADDR'];
// if (is_rate_limited($ip)) {
//     http_response_code(429); // Too Many Requests
//     echo json_encode(['error' => 'Too many requests. Please try again later.']);
//     exit;
// }
// record_request($ip);

// --- Input Handling ---
$query = isset($_GET['q']) ? trim($_GET['q']) : '';
$type = isset($_GET['type']) ? $_GET['type'] : 'autocomplete'; // 'autocomplete' or 'full'

// --- Mock Data ---
$mock_results = [
    ['title' => 'Tropea: La Perla del Tirreno', 'url' => 'articolo.php?slug=tropea-la-perla-del-tirreno', 'type' => 'Articolo'],
    ['title' => 'Spiaggia di Michelino', 'url' => 'articolo.php?slug=spiaggia-di-michelino', 'type' => 'Spiaggia'],
    ['title' => 'Cosenza', 'url' => 'provincia.php?id=1', 'type' => 'Provincia'],
    ['title' => 'Ristorante La Taverna', 'url' => 'articolo.php?slug=ristorante-la-taverna', 'type' => 'Ristorante'],
];


// --- Response Logic ---
if (strlen($query) < 2 && $type === 'autocomplete') {
    // Don't start autocompleting until at least 2 characters are typed
    echo json_encode([]);
    exit;
}

// Filter mock results based on the query (case-insensitive)
$results = array_filter($mock_results, function($item) use ($query) {
    return stripos($item['title'], $query) !== false;
});

// Return the results as JSON
echo json_encode(array_values($results));

exit;
?>
