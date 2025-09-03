<?php
/**
 * api/stripe-webhook.php
 *
 * Listens for events from Stripe (e.g., payment success).
 * This is a critical endpoint for automating subscription activation.
 */
require_once '../includes/db.php';

// --- Webhook Signature Verification (CRITICAL) ---
// This is the most important security step for a webhook endpoint.
// You MUST verify that the request is actually coming from Stripe and not from a malicious actor.
//
// 1. Get the webhook signature from the request headers.
//    $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
//
// 2. Get the raw request body.
//    $payload = @file_get_contents('php://input');
//
// 3. Get your webhook signing secret from your Stripe dashboard.
//    $endpoint_secret = 'whsec_...'; // Store this securely!
//
// 4. Use Stripe's library to construct and verify the event.
// try {
//     $event = \Stripe\Webhook::constructEvent(
//         $payload, $sig_header, $endpoint_secret
//     );
// } catch(\UnexpectedValueException $e) {
//     // Invalid payload
//     http_response_code(400);
//     exit();
// } catch(\Stripe\Exception\SignatureVerificationException $e) {
//     // Invalid signature
//     http_response_code(400);
//     exit();
// }

// If verification fails, you must stop processing immediately.

// --- Handle the Event ---
// At this point, the event is verified and can be trusted.
// $event = json_decode($payload, true); // For simulation purposes

// Example: Handling a successful checkout session
// if ($event['type'] == 'checkout.session.completed') {
//     $session = $event['data']['object'];
//
//     // Retrieve metadata you passed during session creation
//     $user_id = $session['metadata']['user_id'];
//     $package_id = $session['metadata']['package_id'];
//
//     // Fulfill the purchase:
//     // - Activate the user's subscription in your database.
//     // - Change the business status from "in attesa" to "approvato".
//     // - Send a confirmation email.
//     // $db->activateSubscription($user_id, $package_id);
// }


// --- Respond to Stripe ---
// Send a 200 OK response to Stripe to acknowledge receipt of the event.
// If Stripe does not receive a 200 OK, it will continue to retry sending the webhook.
http_response_code(200);

// You can optionally return a JSON message for logging purposes.
header('Content-Type: application/json');
echo json_encode(['status' => 'success']);

exit;
?>
