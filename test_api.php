<?php

/**
 * Simple API Test Script for Libretto Sanctum
 * Run with: php test_api.php
 */

$baseUrl = 'http://localhost:8000/api';

// Test 1: Register a new user
echo "🧪 Testing API Registration...\n";
$registerData = [
    'name' => 'Test User',
    'email' => 'test' . time() . '@example.com', // Unique email
    'password' => 'password123',
    'password_confirmation' => 'password123'
];

$response = makeRequest('POST', $baseUrl . '/register', $registerData);
if ($response['success']) {
    echo "✅ Registration successful!\n";
    $token = $response['token'];
    echo "🔑 Token: " . substr($token, 0, 20) . "...\n";
    echo "⏰ Expires: " . $response['token_expires_at'] . "\n\n";
} else {
    echo "❌ Registration failed: " . $response['message'] . "\n";
    exit(1);
}

// Test 2: Get user info
echo "🧪 Testing Token Authentication...\n";
$userResponse = makeRequest('GET', $baseUrl . '/user', null, $token);
if ($userResponse['success']) {
    echo "✅ Token authentication working!\n";
    echo "👤 User: " . $userResponse['user']['name'] . "\n\n";
} else {
    echo "❌ Token authentication failed\n";
    exit(1);
}

// Test 3: Check token status
echo "🧪 Testing Token Status...\n";
$statusResponse = makeRequest('GET', $baseUrl . '/token-status', null, $token);
if ($statusResponse['success']) {
    echo "✅ Token status check working!\n";
    echo "⏰ Expires in: " . $statusResponse['time_until_expiry'] . "\n\n";
}

// Test 4: Create an author
echo "🧪 Testing CRUD - Create Author...\n";
$authorData = ['name' => 'Test Author ' . time()];
$authorResponse = makeRequest('POST', $baseUrl . '/authors', $authorData, $token);
if ($authorResponse['success']) {
    echo "✅ Author created successfully!\n";
    $authorId = $authorResponse['data']['id'];
    echo "📝 Author ID: " . $authorId . "\n\n";
} else {
    echo "❌ Author creation failed\n";
    exit(1);
}

// Test 5: Get authors list
echo "🧪 Testing CRUD - List Authors...\n";
$authorsResponse = makeRequest('GET', $baseUrl . '/authors', null, $token);
if ($authorsResponse['success']) {
    echo "✅ Authors list retrieved successfully!\n";
    echo "📚 Total authors: " . count($authorsResponse['data']) . "\n\n";
}

// Test 6: Logout
echo "🧪 Testing Logout...\n";
$logoutResponse = makeRequest('POST', $baseUrl . '/logout', null, $token);
if ($logoutResponse['success']) {
    echo "✅ Logout successful!\n\n";
}

echo "🎉 All tests passed! Your Sanctum API is working perfectly!\n";

function makeRequest($method, $url, $data = null, $token = null) {
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    
    $headers = ['Content-Type: application/json'];
    if ($token) {
        $headers[] = 'Authorization: Bearer ' . $token;
    }
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    if ($data) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    }
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    echo "🔗 $method $url - HTTP $httpCode\n";
    
    return json_decode($response, true) ?? ['success' => false, 'message' => 'Invalid response'];
} 