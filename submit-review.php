<?php
header('Content-Type: application/json');

// CORS headers for security
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Get POST data
$input = json_decode(file_get_contents('php://input'), true);

// Validate input
$required = ['name', 'rating', 'comment'];
foreach ($required as $field) {
    if (empty($input[$field])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => "Field $field is required"]);
        exit;
    }
}

// Sanitize input
$name = htmlspecialchars(trim($input['name']), ENT_QUOTES, 'UTF-8');
$rating = intval($input['rating']);
$comment = htmlspecialchars(trim($input['comment']), ENT_QUOTES, 'UTF-8');
$variant = !empty($input['variant']) ? htmlspecialchars(trim($input['variant']), ENT_QUOTES, 'UTF-8') : '';

// Validate rating
if ($rating < 1 || $rating > 5) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Rating must be between 1 and 5']);
    exit;
}

// Validate name length
if (strlen($name) < 2 || strlen($name) > 100) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Name must be between 2 and 100 characters']);
    exit;
}

// Validate comment length
if (strlen($comment) < 10 || strlen($comment) > 500) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Comment must be between 10 and 500 characters']);
    exit;
}

// Read existing reviews
$reviewsFile = 'reviews.json';
$reviews = ['reviews' => []];

if (file_exists($reviewsFile)) {
    $content = file_get_contents($reviewsFile);
    $reviews = json_decode($content, true);
    if (!$reviews || !isset($reviews['reviews'])) {
        $reviews = ['reviews' => []];
    }
}

// Create new review
$newReview = [
    'name' => $name,
    'rating' => $rating,
    'comment' => $comment,
    'date' => date('Y-m-d'),
    'verified' => false // Default to not verified, admin can change manually
];

// Add variant if provided
if (!empty($variant)) {
    $newReview['variant'] = $variant;
}

// Add to beginning of array (newest first)
array_unshift($reviews['reviews'], $newReview);

// Save to file
if (file_put_contents($reviewsFile, json_encode($reviews, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))) {
    echo json_encode([
        'success' => true, 
        'message' => 'Review submitted successfully! Thank you for your feedback.',
        'review' => $newReview
    ]);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Failed to save review']);
}
?>
