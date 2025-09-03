<?php
/**
 * api/stripe-checkout.php
 *
 * API endpoint to create a Stripe Checkout session.
 * This is called when a user clicks the "Scegli e Iscriviti" button.
 */
require_once '../includes/db.php';

header('Content-Type: application/json');

// --- Input Validation ---
// In a real application, you must validate all incoming data.
// Here, we're expecting a 'package_id'.
$package_id = isset($_POST['package_id']) ? (int)$_POST['package_id'] : 0;

if ($package_id <= 0) {
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Invalid package ID.']);
    exit;
}

// Fetch package details from the database to get the price, etc.
// $package = $db->getPackageById($package_id); // Assumes such a method exists
// if (!$package) {
//     http_response_code(404); // Not Found
//     echo json_encode(['error' => 'Package not found.']);
//     exit;
// }


// --- Stripe Integration (Conceptual) ---
// 1. Load the Stripe PHP library: require_once('vendor/stripe/stripe-php/init.php');
// 2. Set your secret key: \Stripe\Stripe::setApiKey('sk_test_...');
//    The key should be stored securely (e.g., in an environment variable), NOT hardcoded.
//    The description mentions it's saved in the database via the admin panel.
//
// 3. Create a Stripe Checkout Session:
// try {
//     $checkout_session = \Stripe\Checkout\Session::create([
//         'payment_method_types' => ['card'],
//         'line_items' => [[
//             'price' => $package['stripe_price_id'], // The Price ID from your Stripe Dashboard
//             'quantity' => 1,
//         ]],
//         'mode' => 'subscription', // or 'payment' for one-time
//         'success_url' => 'https://yourdomain.com/success.php?session_id={CHECKOUT_SESSION_ID}',
//         'cancel_url' => 'https://yourdomain.com/cancel.php',
//         'metadata' => [
//             'user_id' => 123, // The ID of the user or business being registered
//             'package_id' => $package_id
//         ]
//     ]);
//
//     $redirect_url = $checkout_session->url;
//
// } catch (Exception $e) {
//     http_response_code(500);
//     echo json_encode(['error' => 'Failed to create payment session.']);
//     exit;
// }


// --- Mock Response ---
// Since we are not implementing full Stripe integration, we return a mock success response.
$mock_redirect_url = "https://checkout.stripe.com/c/pay/cs_test_a1FAKE_URL_FOR_DEMO_PURPOSES_ONLY";

echo json_encode([
    'success' => true,
    'redirect_url' => $mock_redirect_url
]);

exit;
?>
