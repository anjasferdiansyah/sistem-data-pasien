<?php

echo "Checking Laravel Application Key...\n";

// Check if .env file exists
if (!file_exists('.env')) {
    echo "Error: .env file not found!\n";
    echo "Please create .env file from .env.example\n";
    exit(1);
}

// Read .env content
$envContent = file_get_contents('.env');

// Check if APP_KEY exists and is not empty
if (preg_match('/^APP_KEY=(.+)$/m', $envContent, $matches)) {
    $appKey = trim($matches[1]);
    
    if (!empty($appKey) && $appKey !== 'null') {
        echo "✅ Application key exists: " . substr($appKey, 0, 20) . "...\n";
        echo "Application is ready to run!\n";
        exit(0);
    }
}

echo "❌ Application key is missing or empty!\n";
echo "Generating new application key...\n";

// Generate new key
$output = [];
$returnCode = 0;
exec('C:\xampp\php\php.exe artisan key:generate 2>&1', $output, $returnCode);

if ($returnCode === 0) {
    echo "✅ Application key generated successfully!\n";
    echo "Application is now ready to run!\n";
} else {
    echo "❌ Failed to generate application key:\n";
    echo implode("\n", $output) . "\n";
    exit(1);
}
